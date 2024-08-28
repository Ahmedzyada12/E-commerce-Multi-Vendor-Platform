<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        // Assuming only vendors can see their coupons
        $coupons = Coupon::where('vendor_id', auth()->id())->get();
        return view('Bacckend.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get(); // Fetch all categories to display in the form
        return view('Bacckend.coupons.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id',
        ]);

        Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expiry_date' => $request->expiry_date,
            'vendor_id' => auth()->id(), // Assuming the vendor is authenticated
            'category_id' => $request->category_id, // Linking the coupon to a category
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $categories = Category::all(); // Fetch all categories to display in the form
        return view('Bacckend.coupons.edit', compact('coupon', 'categories'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date|after_or_equal:today',
            // 'category_id' => 'required|exists:categories,id',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}