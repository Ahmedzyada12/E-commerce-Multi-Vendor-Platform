<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('role')->get();
        return view('backend.user.users', ['users' => $users]);
    }

    public function view($id)
    {
        $data = User::with('orders')->where('id', $id)->first();
        // dd($data);
        return view('backend.user.usersdetails', compact('data'));
    }

    public function viewOrder($id)
    {
        $order = Order::with('cart')->where('id', $id)
            ->first();
        // $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('Bacckend.order.vieworder', compact('order'));
    }
    public function indexorder()
    {
        $id = Auth::user()->id;
        $orders = Order::with(['orderItems'])->where('vendor_id', $id)
            ->get();
        // dd($orders);
        return view('Bacckend.order.indexorder', compact('orders'));
    }
}
