<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorahController extends Controller
{
    public $mfObj;

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function __construct()
    {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Create MyFatoorah invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Fetch cart items and calculate total price
            $cartItems = Cart::where('user_id', auth()->id())->get();
            $totalPrice = 0;
            $vendorId = $request->input('vendor_id');
            $discount = 0;
            $adminId =  1; // Assuming admin has ID 1, change this as needed

            foreach ($cartItems as $item) {
                if ($item->product->vendor_id == $vendorId) {
                    $totalPrice += $item->quantity * $item->product->price;
                }
            }

            // Handle coupon
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)->where('vendor_id', $vendorId)->first();

                if ($coupon) {
                    if ($coupon->expiry_date && $coupon->expiry_date < now()) {
                        return redirect()->back()->with('warning', 'Coupon has expired');
                    }

                    if ($coupon->type == 'fixed') {
                        $discount = $coupon->value;
                    } else if ($coupon->type == 'percent') {
                        $discount = ($coupon->value / 100) * $totalPrice;
                    }
                    $totalPrice -= $discount;
                } else {
                    return redirect()->back()->with('warning', 'Invalid coupon code or does not apply to this vendor');
                }
            }

            // Calculate vendor commission
            $commission = $totalPrice * 0.30;
            $vendorAmount = $totalPrice - $commission;

            // Update vendor and admin balances
            $vendor = User::find($vendorId);
            $admin = User::where('role_id', 1)->first();
        
            if ($vendor) {
                $vendor->balance += $vendorAmount;
                $vendor->save();
            } else {
                return redirect()->back()->with('warning', 'Vendor not found');
            }
            if ($admin) {
                $admin->balance += $commission;
                $admin->save();
            } else {
                return redirect()->back()->with('warning', 'Admin not found');
            }

            // Create new order
            $order = new Order();
            $order->number = uniqid(); // Generate a unique order number
            $order->first_name = $request->input('first_name');
            $order->last_name = $request->input('last_name');
            $order->email = $request->input('email');
            $order->phone = $request->input('phone');
            $order->street_address = $request->input('street_address');
            $order->city = $request->input('city');
            $order->postal_code = $request->input('postal_code');
            $order->country = $request->input('country');
            $order->vendor_id = $vendorId;
            $order->user_id = auth()->id();
            $order->total_price = $totalPrice;
            $order->coupon_code = $request->coupon_code;
            $order->discount = $discount;
            $order->save();

            // Save order items
            foreach ($cartItems as $item) {
                if ($item->product->vendor_id == $vendorId) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'vendor_id' => $item->product->vendor_id,
                    ]);
                    // Update product quantity
                    $prod = Product::find($item->product_id);
                    $prod->amount -= $item->quantity;
                    $prod->save();
                }
            }
            Cart::where('user_id', auth()->id())->delete();
            // Generate MyFatoorah payment payload
            $curlData = $this->getPayLoadData($order);
            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode
            $data = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);

            return redirect()->to($data['invoiceURL']);
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
    }









    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param int|string $orderId
     * @return array
     */

    private function getPayLoadData(Order $order)
    {
        $callbackURL = route('myfatoorah.callback');

        return [
            'CustomerName'       => auth()->user()->name,
            'InvoiceValue'       => $order->total_price, // Use the total price from the order
            'DisplayCurrencyIso' => 'EGP',
            'CustomerEmail'      => auth()->user()->email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $order->phone,
            'MobileCountryCode'  => '+20',
            'Language'           => 'en',
            'CustomerReference'  => $order->id,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }


    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Get MyFatoorah payment information
     * 
     * @return \Illuminate\Http\Response
     */



    public function callback()
    {
        try {
            $data = $this->mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');

            $orderId = $data->CustomerReference;
            $order = Order::find($orderId);
            switch ($data->InvoiceStatus) {
                case 'Paid':
                    $order->status = 'paid';
                    $msg = 'Invoice is paid.';
                    break;
                case 'Failed':
                    $order->status = 'failed';
                    $msg = 'Invoice is not paid due to ' . $data->InvoiceError;
                    break;
                case 'Expired':
                    $order->status = 'expired';
                    $msg = 'Invoice is expired.';
                    break;
                default:
                    $order->status = 'unknown';
                    $msg = 'Unknown payment status.';
                    break;
            }
            if (isset($data->InvoiceTransactions) && is_array($data->InvoiceTransactions) && !empty($data->InvoiceTransactions)) {
                $transaction = $data->InvoiceTransactions[0];
                if (isset($transaction->PaymentGateway)) {
                    $order->payment_gateway = $transaction->PaymentGateway;
                }
            }
            // Save the updated order status and payment gateway
            $order->save();
            return view('frontend.eCommerce.tnx');
            // return response()->json(['IsSuccess' => 'true', 'Message' => $msg, 'Data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
    }
}