<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $products = Product::when($request->subcategory, function ($query) use ($request) {
            $query->where('category_id', $request->subcategory);
        })->when($request->min_price && $request->max_price, function ($query) use ($request) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        })->when($request->category, function ($query) use ($request) {
            $query->whereHas('subcategory.category', function ($subQuery) use ($request) {
                $subQuery->where('id', $request->category);
            });
        })->paginate(5);

        $cats = Category::with('subcategory')->where('parent_id', 0)->get();
        return view('frontend.eCommerce.shop', compact('products', 'cats'));
    }
    
}