<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckCartQuantities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();

            foreach ($cartItems as $item) {
                if ($item->quantity > $item->product->amount) {
                    return redirect()->route('productcart')->with('warning', 'One or more items in your cart exceed available stock.');
                }
            }
        }

        return $next($request);
    }
}