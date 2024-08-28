<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class VendorProductHomeController extends Controller
{
    public function home()
    {
        $vendorId = auth()->id(); // Get the authenticated user's ID

        $Recents = Product::where('vendor_id', $vendorId)->latest()->limit(8)->get();
        $Mobiles = Product::where('vendor_id', $vendorId)
            ->whereHas('subcategory.category', function ($query) {
                $query->where('name', 'mobiles');
            })->with('subcategory.category')->latest()->limit(8)->get();
        $Electronics = Product::where('vendor_id', $vendorId)
            ->whereHas('subcategory.category', function ($query) {
                $query->where('name', 'Electronics');
            })->with('subcategory.category')->latest()->limit(8)->get();
        $Clothes = Product::where('vendor_id', $vendorId)
            ->whereHas('subcategory.category', function ($query) {
                $query->where('name', 'Fashion');
            })->with('subcategory.category')->latest()->limit(8)->get();

        return view('frontend.eCommerce.vendor.index', compact('Recents', 'Mobiles', 'Electronics', 'Clothes'));
    }
    public function details($id)
    {
        $vendorId = auth()->id(); // Get the authenticated vendor's ID

        // Retrieve the product with the specified ID and vendor_id
        $product = Product::with(['productImages', 'reviews.user'])
            ->where('id', $id)
            ->where('vendor_id', $vendorId)
            ->firstOrFail();

        // Process tags, colors, and sizes
        $product->tag = $product->tag ? explode(',', $product->tag) : [];
        $product->color = $product->color ? explode(',', $product->color) : [];
        $product->size = $product->size ? explode(',', $product->size) : [];
        $product['tag'] = Tag::findMany($product->tag);
        $product['color'] = Color::findMany($product->color);
        $product['size'] = Size::findMany($product->size);

        // Get categories and subcategories
        $categories = Category::where('parent_id', 0)->get();
        $subCats = Category::where('parent_id', $product->subcategory->category->id)->get();
        $product_image = ProductImage::where('product_id', $product->id)->get();

        // Get reviews
        $reviews = $product->reviews()->with('user')->get();

        // Return the view with the product details
        
        return view('frontend.eCommerce.vendor.productDetails', compact('product', 'categories', 'subCats', 'product_image', 'reviews'));
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('VendorAllProduct');
        // return back();
    }
}