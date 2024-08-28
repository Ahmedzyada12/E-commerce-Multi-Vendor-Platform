<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
// use Session;
// use Alert;

class CartController extends Controller
{
    public function cart()
    {
        $cartItem = Cart::where('user_id', Auth::id())->get();

        $total = 0;
        foreach ($cartItem as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('frontend.eCommerce.cart', compact('cartItem', 'total'));
    }

    // public function addToCart(Request $request)
    // {
    //     $product_id  = $request->input('product_id');
    //     $product_qty = $request->input('quantity');
    //     $product_size = $request->input('product_size');
    //     $product_color = $request->input('product_color');

    //     if (Auth::check() && auth()->user()->role_id == 2) {
    //         $user = Auth::user();
    //         if ($user) {
    //             $product_check = Product::where('id', $product_id)->first();
    //             if ($product_check) {
    //                 if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
    //                     // Alert::warning('Warning Title', ' Already In Cart');
    //                     // return redirect()->route('homePage')->with('Warning Title', 'Already In Cart');
    //                     response()->json(['status' => $product_check->name . " Already In Cart"]);
    //                 } else {
    //                     $cartItem = new Cart();
    //                     $cartItem->product_id = $product_id;
    //                     $cartItem->user_id = Auth::id();
    //                     $cartItem->product_size = $product_size;
    //                     $cartItem->product_color = $product_color;
    //                     $cartItem->quantity = $product_qty;
    //                     $cartItem->vendor_id = $product_check->vendor_id; // Assuming product has vendor_id
    //                     $cartItem->save();
    //                     // dd($cartItem);
    //                     return redirect()->route('productcart');
    //                 }
    //             }
    //         }
    //     } else {
    //         return response()->json(['status' => "Please Login First.."]);
    //     }
    // }

    public function addToCart(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->back()->with('warning', 'Please login');
        }
        
        if (auth()->user()->role_id != 2) {
            return redirect()->route('homePage')->with('status', 'Unauthorized access.');
        }

        $product_id  = $request->input('product_id');
        $product_qty = $request->input('quantity');
        $product_size = $request->input('product_size');
        $product_color = $request->input('product_color');

        $user = Auth::user();

        if ($user) {
            // Check if the product exists
            $product_check = Product::where('id', $product_id)->first();

            if ($product_check) {
                // Check if requested quantity exceeds available amount
                if ($product_qty > $product_check->amount) {
                    return redirect()->back()->with('warning', 'Requested quantity exceeds available stock');
                }

                if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return redirect()->back()->with('warning', $product_check->name . " is already in your cart");
                } else {
                    // Add the product to the cart
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_size = $product_size;
                    $cartItem->product_color = $product_color;
                    $cartItem->quantity = $product_qty;
                    $cartItem->vendor_id = $product_check->vendor_id; // Assuming product has vendor_id
                    $cartItem->save();

                    return redirect()->route('productcart')->with('success', 'Product added to cart');
                }
            } else {
                return redirect()->back()->with('warning', 'Product not found');
            }
        }
        return redirect()->back()->with('warning', 'Something went wrong');
    }



    public function removeitem($id)
    {
        Cart::destroy($id);
        return redirect()->route('productcart')->with('success', 'Product removed');
    }
    public function removeallitem()
    {
        $userid = auth()->id();
        Cart::where('user_id', $userid)->delete();
        return redirect()->route('productcart')->with('success', 'Products  removed');
    }

    public function updateCart(Request $request, $cartItemid)
    {
        $validate = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cartItem = Cart::where('id', $cartItemid)->where('user_id', auth()->id())->first();
        if ($cartItem->product->amount >= $cartItem->quantity) {
            $cartItem->update([
                'quantity' => $validate['quantity'],
            ]);
        }
        return back()->with('success', 'Product is update quantity ');
    }
}