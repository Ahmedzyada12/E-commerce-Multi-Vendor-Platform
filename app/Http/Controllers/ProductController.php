<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Models\Manger;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{

    public function index()
    {
        $products = Product::count();
        $users = User::count();
        $adminBalances = User::where('role_id', 1)->sum('balance');
        $orders = Order::count();
        $admins = User::where('role_id', 1)->count();
        $vendors = User::where('role_id', 3)->count();

        return view("Bacckend.index", compact('products', 'users', 'admins', 'vendors', 'orders', 'adminBalances'));
        // return view("Bacckend.index");
    }

    public function count()
    {

        $products = Product::count();
        $users = User::count();
        $adminBalances = User::where('role_id', 1)->sum('balance');
        $orders = Order::count();
        $admins = User::where('role_id', 1)->count();
        $vendors = User::where('role_id', 3)->count();

        return view("Bacckend.index", compact('products', 'users', 'admins', 'vendors', 'orders', 'adminBalances'));
    }
    public function vendorsWithBalances()
    {
        $vendorsWithBalances = User::where('role_id', 3)->get(['id', 'name', 'balance']);
    
        foreach ($vendorsWithBalances as $vendor) {
            $total_price = Order::where('vendor_id', $vendor->id)->sum('total_price');
            $vendor->discount = $total_price * 0.30;
        }
        $adminBalance = User::where('role_id', 1)->sum('balance');
        return view("Bacckend.admin.vendor_with_balance", compact('vendorsWithBalances', 'adminBalance'));
    }



    public function count_vendor()
    {
        $id = auth()->user()->id;
        $products = Product::where('vendor_id', $id)->count();

        // $id = Auth::user()->id;
        $orders = Order::with(['orderItems.product'])->where('vendor_id', Auth::user()->id)->get();
        $total_price = Order::where('vendor_id', Auth::user()->id)->sum('total_price');

        if (auth()->check() && auth()->user()->role_id == 3) {
            $vendorBalance = auth()->user()->balance;
            $Discount = $total_price - $vendorBalance;

            return view("Bacckend.vendor.products.indexcount", compact('products', 'orders', 'total_price', 'vendorBalance', 'Discount'));
        } else {

            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        return view("Bacckend.vendor.products.indexcount", compact('products', 'orders', 'total_price', 'vendorBalance'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function productByCategoryId($id)
    {
        $products = Product::where('category_id', $id)->get();
        // $products = ProductResource::collection($products);

        foreach ($products as $product) {

            $product->tag = $product->tag ? explode(',', $product->tag) : [];
            $product->color = $product->color ? explode(',', $product->color) : [];
            $product->size = $product->size ? explode(',', $product->size) : [];

            $product['tag'] = Tag::findMany($product->tag);
            $product['color'] = Color::findMany($product->color);
            $product['size'] = Size::findMany($product->size);
        }
        return view('Bacckend.products.viewproducts', compact('products'));
    }
    // public function getproducts(Request $request)
    // {
    //     $products = Product::all();
    //     // $products = ProductResource::collection($products);

    //     foreach ($products as $product) {

    //         $product->tag = $product->tag ? explode(',', $product->tag) : [];
    //         $product->color = $product->color ? explode(',', $product->color) : [];
    //         $product->size = $product->size ? explode(',', $product->size) : [];

    //         $product['tag'] = Tag::findMany($product->tag);
    //         $product['color'] = Color::findMany($product->color);
    //         $product['size'] = Size::findMany($product->size);
    //     }

    //     return view('Bacckend.products.viewproducts', compact('products'));
    // }
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        foreach ($products as $product) {

            $product->tag = $product->tag ? explode(',', $product->tag) : [];
            $product->color = $product->color ? explode(',', $product->color) : [];
            $product->size = $product->size ? explode(',', $product->size) : [];

            $product['tag'] = Tag::findMany($product->tag);
            $product['color'] = Color::findMany($product->color);
            $product['size'] = Size::findMany($product->size);
        }

        return view('Bacckend.vendor.products.viewproducts', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        // $subCats = Category::where('parent_id', '!=', 0)->get();
        $tags = Tag::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('Bacckend.products.create', compact('tags', 'colors', 'sizes', 'categories'));
    }

    public function VendorStoreProduct(Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     // 'images' => 'array|nullable',
        //     // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'category_id' => 'required|exists:categories,id',
        //     'price' => 'required|integer',
        //     'amount' => 'nullable|integer',
        //     'tag' => 'nullable|array',
        //     'vendor_id' => 'required',
        //     'inches' => 'nullable|string',
        //     'description' => 'nullable|string',
        // ]);
        $data = $request->except(['images', 'size', 'color']);
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalName();
            $destinationPath = public_path('/images');
            $img->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        $data['vendor_id'] = auth()->id();
        $tag = $request->tag ? json_encode($request->tag) : null;
        $data['tag'] = $tag;

        $product = Product::create($data);
        $product->colors()->attach($request->color);
        $product->sizes()->attach($request->size);
        // upload images of product
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $img) {
                $imageName = time() . '.' . $img->getClientOriginalName();
                $destinationPath = public_path('/product_images');
                $img->move($destinationPath, $imageName);
                $path = $imageName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $path,
                ]);
            }
        }
        noty()->addSuccess('Created Successfully.');
        return redirect()->route('VendorAllProduct')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $product = Product::with('subcategory.category')->findOrFail($id);
        $product->tag = $product->tag ? explode(',', $product->tag) : [];
        $product->color = $product->color ? explode(',', $product->color) : [];
        $product->size = $product->size ? explode(',', $product->size) : [];

        $categories = Category::where('parent_id', 0)->get();

        $subCats = Category::where('parent_id', $product->subcategory->category->id)->get();

        $tags = Tag::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('Bacckend.products.edit', compact('product', 'categories', 'subCats', 'tags', 'colors', 'sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $category)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $products = Product::all();
    //     foreach ($products as $product) {

    //         $product->tag = $product->tag ? explode(',', $product->tag) : [];
    //         $product->color = $product->color ? explode(',', $product->color) : [];
    //         $product->size = $product->size ? explode(',', $product->size) : [];

    //         $product['tag'] = Tag::findMany($product->tag);
    //         $product['color'] = Color::findMany($product->color);
    //         $product['size'] = Size::findMany($product->size);
    //     }

    //     $data = $request->validate([
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'category_id' => 'required|integer|exists:categories,id',
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|integer',
    //         'color' => 'nullable|array',
    //         'size' => 'nullable|array',
    //         'tag' => 'nullable|array',
    //         'amount' => 'nullable|integer',
    //         'inches' => 'nullable|string',
    //         'description' => 'nullable|string',
    //     ]);
    //     $product = Product::findOrFail($id);
    //     // $data = Arr::except($data, ['image', 'images']);
    //     $tag = $request->tag ? implode(",", $request->tag) : null;
    //     $product->colors()->attach($request->color);
    //     $product->sizes()->attach($request->size);
    //     $data['tag'] = $tag;

    //     if ($request->hasFile('image')) {
    //         $img = $request->file('image');
    //         $imageName = time() . '.' . $img->getClientOriginalName();
    //         $destinationPath = public_path('/images');
    //         $img->move($destinationPath, $imageName);
    //         $data['image'] = $imageName;
    //     } else {
    //         $data['image'] = $product->image;
    //     }

    //     $product->update($data);

    //     if ($request->hasFile('images')) {

    //         $product->productImages()->delete();
    //         $uploadedImages = $request->file('images');
    //         foreach ($uploadedImages as $img) {
    //             $imageName = time() . '.' . $img->getClientOriginalName();
    //             $destinationPath = public_path('/product_images');
    //             $img->move($destinationPath, $imageName);
    //             $path = $imageName;
    //             ProductImage::create([
    //                 'product_id' => $product->id,
    //                 'name' => $path,
    //             ]);
    //         }
    //     }
    //     return view('Bacckend.products.viewproducts', compact('products'));
    // }

    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        // $data = $request->validate([
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'category_id' => 'required|integer|exists:categories,id',
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|integer',
        //     'color' => 'nullable|array',
        //     'size' => 'nullable|array',
        //     'tag' => 'nullable|array',
        //     'amount' => 'nullable|integer',
        //     'inches' => 'nullable|string',
        //     'description' => 'nullable|string',
        // ]);

        // Prepare tags

        $data = $request->except(['images', 'size', 'color']);

        $data['tag'] = $request->tag ? implode(",", $request->tag) : null;

        // Update product image if a new image is uploaded
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $img->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        // Update product details
        $product->update($data);
        // Detach existing color and size associations
        $product->colors()->detach();
        $product->sizes()->detach();

        // Attach new color and size associations if provided
        if ($request->color) {
            $product->colors()->attach($request->color);
        }
        if ($request->size) {
            $product->sizes()->attach($request->size);
        }
        // Update product images if new images are uploaded
        if ($request->hasFile('images')) {
            // Delete existing product images
            $product->productImages()->delete();

            // Upload new images
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $img) {
                $imageName = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/product_images');
                $img->move($destinationPath, $imageName);
                $path = $imageName;

                // Create new product image record
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $path,
                ]);
            }
        }

        $products = Product::all();
        foreach ($products as $prod) {
            $prod->tag = $prod->tag ? explode(',', $prod->tag) : [];
            $prod->color = $prod->color ? explode(',', $prod->color) : [];
            $prod->size = $prod->size ? explode(',', $prod->size) : [];
            $prod['tag'] = Tag::findMany($prod->tag);
            $prod['color'] = Color::findMany($prod->color);
            $prod['size'] = Size::findMany($prod->size);
        }

        // Return the view with updated product data
        return view('Bacckend.products.viewproducts', compact('products'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('VendorAllProduct');
        // return back();
    }
}