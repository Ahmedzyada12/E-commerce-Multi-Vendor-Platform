<?php

namespace App\Http\Controllers\apicontroller;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeProductController extends Controller
{
    public function details($id)
    {
        $product = Product::with(['productImages', 'reviews.user'])->findOrFail($id);
        $product->tag = $product->tag ? explode(',', $product->tag) : [];
        $product->color = $product->color ? explode(',', $product->color) : [];
        $product->size = $product->size ? explode(',', $product->size) : [];
        $product['tag'] = Tag::findMany($product->tag);
        $product['color'] = Color::findMany($product->color);
        $product['size'] = Size::findMany($product->size);

        // $categories = Category::where('parent_id', 0)->get();
        // $subCats = Category::where('parent_id', $product->subcategory->category->id)->get();
        // $product_images = ProductImage::where('product_id', $product->id)->get();
        $reviews = $product->reviews()->with('user')->get();

        return response()->json([
            'product' => $product,
            // 'categories' => $categories,
            // 'subCategories' => $subCats,
            // 'productImages' => $product_images,
            'reviews' => $reviews,
        ], 200);
    }
    public function home()
    {
        $recents = Product::latest()->limit(8)->get();
        $mobiles = Product::whereHas('subcategory.category', function ($query) {
            $query->where('name', 'mobiles');
        })->with('subcategory.category')->latest()->limit(8)->get();
        $tools = Product::whereHas('subcategory.category', function ($query) {
            $query->where('name', 'tools');
        })->with('subcategory.category')->latest()->limit(8)->get();
        $clothes = Product::whereHas('subcategory.category', function ($query) {
            $query->where('name', 'clothes');
        })->with('subcategory.category')->latest()->limit(8)->get();
    
        return response()->json([
            'message'=>'get data ',
            'recents' => $recents,
            'mobiles' => $mobiles,
            'tools' => $tools,
            'clothes' => $clothes
        ], 200);
    }
}