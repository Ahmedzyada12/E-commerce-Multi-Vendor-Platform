<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Manger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDController extends Controller
{
    public function manageRole()
    {
        $users = User::get();;
        // $admins = Manger::get();
        $roles = Role::all();
        return view('Bacckend.admin.mange_role', compact('roles', 'users'));
    }
    public function manageAdmin()
    {
        $admins = User::with('role')->where('role_id', '=', 1)->get();;
        return view('Bacckend.admin.mange_admins', compact('admins'));
    }
    public function manageVendor()
    {
        $vendors = User::with('role')->where('role_id', '=', 3)->get();;
        return view('Bacckend.admin.mange_vendors', compact('vendors'));
    }
    public function manageUser()
    {
        $users = User::with('role')->where('role_id', '=', 2)->get();;
        return view('Bacckend.admin.mange_users', compact('users'));
    }

    public function updateRole(Request $request)
    {
        $user = User::where('id', $request->user_id)->update([
            'role_id' => $request->role_id
        ]);
        return redirect()->back();
    }
    public function indexorders()
    {
        $id = Auth::user()->id;
        $orders = Order::with(['orderItems', 'vendor'])->get();
        // dd($orders);
        return view('Bacckend.all_orders.indexorder', compact('orders'));
    }
    public function viewOrders($id)
    {
        $order = Order::with('cart')->where('id', $id)
            ->first();
        // $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('Bacckend.all_orders.vieworder', compact('order'));
    }
}
