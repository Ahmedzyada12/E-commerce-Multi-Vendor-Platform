<?php

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MSessionCartToUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    public function handle(Login $event): void
    {
        $user = $event->user;
        if (session()->has('cart')) {
            $cartitem = session()->get('cart');
            foreach ($cartitem as $product_qty => $details) {
                Cart::updateOrCreate(
                    ['user_id' => $user->id, 'product_id' => $product_qty],

                );
            }
        }
        session()->forget('cart');
    }
}
