<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Cart;
use App\Models\Size;
use App\Models\Color;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $recents = Product::latest()->limit(8)->get();
        $cats = Category::with('subcategory')->where('parent_id', 0)->limit(4)->get();
        // $mobiles = Product::whereHas('subcategory.category', function ($query) {
        //     $query->where('name', 'mobiles');
        // })->with('subcategory.category')->latest()->limit(8)->get();
        // $Electronics = Product::whereHas('subcategory.category', function ($query) {
        //     $query->where('name', 'Electronic');
        // })->with('subcategory.category')->latest()->limit(8)->get();
        // $clothes = Product::whereHas('subcategory.category', function ($query) {
        //     $query->where('name', 'Fashion');
        // })->with('subcategory.category')->latest()->limit(8)->get();

        return view('frontend.eCommerce.index', compact('recents', 'categories', 'cats'));
    }

    public function details($id)
    {

        $product = Product::with('productImages')->with('reviews.user')->findOrFail($id);
        $product->tag = $product->tag ? explode(',', $product->tag) : [];
        $product->color = $product->color ? explode(',', $product->color) : [];
        $product->size = $product->size ? explode(',', $product->size) : [];
        $product['tag'] = Tag::findMany($product->tag);
        $product['color'] = Color::findMany($product->color);
        $product['size'] = Size::findMany($product->size);

        $categories = Category::where('parent_id', 0)->get();
        $subCats = Category::where('parent_id', $product->subcategory->category->id)->get();
        $product_image = ProductImage::where('product_id', $product->id)->get();
        // $product = Product::with(['reviews.user'])->findOrFail($id);
        $reviews = $product->reviews()->with('user')->get();

        return view('frontend.eCommerce.productDetails', compact('product', 'categories', 'subCats', 'product_image', 'reviews'));
    }

    // public function cats(Request $request)
    // {
    //     $cats = Category::with('subcategory')->where('parent_id', 0)->get();
    //     return view('frontend.eCommerce.index', compact('cats'));
    // }
}
