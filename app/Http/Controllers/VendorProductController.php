<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    // public function VendorAllProduct()
    // {
    //     $id = Auth::user()->id;
    //     $products = Product::where('vendor_id', $id)->latest()->get();
    //     foreach ($products as $product) {

    //         $product->tag = $product->tag ? explode(',', $product->tag) : [];
    //         $product->color = $product->color ? explode(',', $product->color) : [];
    //         $product->size = $product->size ? explode(',', $product->size) : [];

    //         $product['tag'] = Tag::findMany($product->tag);
    //         $product['color'] = Color::findMany($product->color);
    //         $product['size'] = Size::findMany($product->size);
    //     }

    //     return view('Bacckend.vendor.products.viewproducts', compact('products'));
    // }
    public function getallSubCategory(Request $request)
    {
        $subCats = Category::where('parent_id', $request->id)->get();
        return $subCats;
    }
    public function VendorAddProduct()
    {
        $vendorId = Auth::id();
        $tags = Tag::all();
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::where('parent_id', 0)->where('vendor_id', $vendorId)->get();
        return view('Bacckend.vendor.products.create', compact('categories', 'tags', 'colors', 'sizes',));
    }

    public function VendorStoreProduct(Request $request)
    {
        $data = $request->except(['images', 'size', 'color', 'name_en', 'name_ar', 'description_en', 'description_ar']);

        // معالجة الصورة الرئيسية
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalName();
            $destinationPath = public_path('/images');
            $img->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        // تعيين معرف البائع
        $data['vendor_id'] = auth()->id();

        // معالجة العلامات (tags)
        $tag = $request->tag ? json_encode($request->tag) : null;
        $data['tag'] = $tag;

        // إنشاء المنتج مع ترجمة الحقول
        $product = new Product();
        $product->fill($data);

        // تعيين الترجمات
        $product->setTranslations('name', [
            'en' => $request->input('name_en'),
            'ar' => $request->input('name_ar'),
        ]);

        $product->setTranslations('description', [
            'en' => $request->input('description_en'),
            'ar' => $request->input('description_ar'),
        ]);

        // حفظ المنتج
        $product->save();

        // ربط الألوان والأحجام
        $product->colors()->attach($request->color);
        $product->sizes()->attach($request->size);

        // تحميل صور إضافية للمنتج
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

    public function updateproduct(Request $request, $id)
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
        $data['vendor_id'] = auth()->id();
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
        return redirect()->route('VendorAllProduct')->with('Add', 'updated successfully');
    }
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
        return view('Bacckend.vendor.products.edit', compact('product', 'categories', 'subCats', 'tags', 'colors', 'sizes'));
    }
}
