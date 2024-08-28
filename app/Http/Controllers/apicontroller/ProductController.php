<?php

namespace App\Http\Controllers\apicontroller;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\User;
use App\Models\Manger;
use App\Models\Tag;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function count()
    {
        $products = Product::count();
        $users = User::count();
        $admins = Manger::count();

        return response()->json([
            'products' => $products,
            'users' => $users,
            'admins' => $admins
        ], 200);
    }

    public function productByCategoryId($id)
    {
        $products = Product::where('category_id', $id)->get();

        foreach ($products as $product) {
            $product->tag = $product->tag ? explode(',', $product->tag) : [];
            $product->color = $product->color ? explode(',', $product->color) : [];
            $product->size = $product->size ? explode(',', $product->size) : [];

            $product['tag'] = Tag::findMany($product->tag);
            $product['color'] = Color::findMany($product->color);
            $product['size'] = Size::findMany($product->size);
        }

        return response()->json($products, 200);
    }

    public function getproducts(Request $request)
    {
        $products = Product::all();

        foreach ($products as $product) {
            $product->tag = $product->tag ? explode(',', $product->tag) : [];
            $product->color = $product->color ? explode(',', $product->color) : [];
            $product->size = $product->size ? explode(',', $product->size) : [];

            $product['tag'] = Tag::findMany($product->tag);
            $product['color'] = Color::findMany($product->color);
            $product['size'] = Size::findMany($product->size);
        }

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $data = $request->except(['images', 'size', 'color']);
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalName();
            $destinationPath = public_path('/images');
            $img->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        $tag = $request->tag ? json_encode($request->tag) : null;
        $data['tag'] = $tag;

        $product = Product::create($data);
        $product->colors()->attach($request->color);
        $product->sizes()->attach($request->size);

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

        return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::with('subcategory.category')->findOrFail($id);
        $product->tag = $product->tag ? explode(',', $product->tag) : [];
        $product->color = $product->color ? explode(',', $product->color) : [];
        $product->size = $product->size ? explode(',', $product->size) : [];

        // $categories = Category::where('parent_id', 0)->get();
        // $subCats = Category::where('parent_id', $product->subcategory->category->id)->get();

        $tags = Tag::all();
        $colors = Color::all();
        $sizes = Size::all();

        return response()->json([
            'product' => $product,
            // 'categories' => $categories,
            // 'subCategories' => $subCats,
            'tags' => $tags,
            'colors' => $colors,
            'sizes' => $sizes
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->except(['images', 'size', 'color']);
        $data['tag'] = $request->tag ? implode(",", $request->tag) : null;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $img->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);
        $product->colors()->sync($request->color);
        $product->sizes()->sync($request->size);

        if ($request->hasFile('images')) {
            $product->productImages()->delete();
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $img) {
                $imageName = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/product_images');
                $img->move($destinationPath, $imageName);
                $path = $imageName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $path,
                ]);
            }
        }

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
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
        })->paginate(10); 

        $cats = Category::with('subcategory')->where('parent_id', 0)->get();

        return response()->json([
            'products' => $products,
            'categories' => $cats
        ], 200);
    }
}