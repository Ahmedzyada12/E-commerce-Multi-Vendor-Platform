<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $CartItem = Cart::where('user_id', Auth::id())->get();
        $total = 0;
        return view('frontend.eCommerce.checkout', compact('CartItem', 'total'));
    }
    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'first_name' =>'required',
    //     //     'last_name' =>'required',
    //     //     'email' =>'required',
    //     //     'phone' =>'required',
    //     //     'street_address' =>'required',
    //     //     'city' =>'required',
    //     //     'postal_code' =>'required',
    //     //     'country' =>'required',
    //     // ]);
    //     DB::beginTransaction();
    //     try {

    //         $number = Order::whereYear('created_at', Carbon::now()->year)->max('number');
    //         $number + 010;
    //         $number++;

    //         $order  = new Order();
    //         $order->number = $number;
    //         $order->first_name = $request->input('first_name');
    //         $order->last_name = $request->input('last_name');
    //         $order->email = $request->input('email');
    //         $order->phone = $request->input('phone');
    //         $order->street_address = $request->input('street_address');
    //         $order->city = $request->input('city');
    //         $order->postal_code = $request->input('postal_code');
    //         $order->country = $request->input('country');
    //         // $order->vendor_id = $request->input('vendor_id');
    //         $order->user_id = Auth::id();
    //         $order->save();

    //         $order->id;
    //         $cartitem = Cart::where('user_id', Auth::id())->get();
    //         foreach ($cartitem as $item) {
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $item->product_id,
    //                 'quantity' => $item->quantity,
    //                 'price' => $item->product->price,

    //             ]);
    //             $prod = Product::where('id', $item->product_id)->first();
    //             $prod->amount = $prod->amount - $item->quantity; // update amount for product
    //             $prod->update();
    //         }
    //         $userid = auth()->id();
    //         Cart::where('user_id', $userid)->delete();
    //         DB::commit();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //     }
    //     return redirect()->route('homePage')->with('success', 'Your order has been placed successfully');
    // }
    public function store(Request $request)
    {

        return $request;
        $request->validate([
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'email' => 'required|email',
            // 'phone' => 'required',
            // 'street_address' => 'required',
            // 'city' => 'required',
            // 'postal_code' => 'required',
            // 'country' => 'required',
        ]);

        // DB::beginTransaction();
        // try {
        // $number = 10125;
        // $number = $number + 1; // Ensure number is incremented correctly
        $currentYear = Carbon::now()->year;
        $maxOrderNumber = Order::whereYear('created_at', $currentYear)->max('number');
        $number = $maxOrderNumber ? $maxOrderNumber + 1 : 1;

        // Create the new order
        // $order = new Order();
        // $order->number = $number;
        // $order->first_name = $request->input('first_name');
        // $order->last_name = $request->input('last_name');
        // $order->email = $request->input('email');
        // $order->phone = $request->input('phone');
        // $order->street_address = $request->input('street_address');
        // $order->city = $request->input('city');
        // $order->postal_code = $request->input('postal_code');
        // $order->country = $request->input('country');
        // $order->vendor_id = $request->input('vendor_id');
        // $order->user_id = Auth::id();
        // $order->save();
        // // dd($order);
        // $cartitems = Cart::where('user_id', Auth::id())->get();

        // foreach ($cartitems as $item) {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $item->product_id,
        //         'quantity' => $item->quantity,
        //         'price' => $item->product->price,
        //         'vendor_id' => $item->product->vendor_id, // Ensure vendor_id is stored correctly
        //     ]);

        //     $prod = Product::where('id', $item->product_id)->first();
        //     $prod->amount -= $item->quantity; // update amount for product
        //     $prod->save();
        // }
        $order = new Order();
        $order->number = $number;
        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->street_address = $request->input('street_address');
        $order->city = $request->input('city');
        $order->postal_code = $request->input('postal_code');
        $order->country = $request->input('country');
        $order->vendor_id = $request->input('vendor_id');
        $order->user_id = Auth::id();

        // Initialize total price
        $totalPrice = 0;

        // Fetch cart items
        $cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($cartItems as $item) {
            // Calculate total price
            $totalPrice += $item->quantity * $item->product->price;
        }

        // Assign total price to the order and save
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($cartItems as $item) {
            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'vendor_id' => $item->product->vendor_id, // Ensure vendor_id is stored correctly
            ]);

            // Update product amount
            $prod = Product::where('id', $item->product_id)->first();
            $prod->amount -= $item->quantity;
            $prod->save();
        }

        Cart::where('user_id', Auth::id())->delete();
        // DB::commit();

        return redirect()->route('homePage')->with('success', 'Your order has been placed successfully');

        // } catch (Exception $e) {
        //         DB::rollBack();
        //         return redirect()->route('homePage')->with('error', 'Failed to place order: ' . $e->getMessage());
        //     }
    }
}