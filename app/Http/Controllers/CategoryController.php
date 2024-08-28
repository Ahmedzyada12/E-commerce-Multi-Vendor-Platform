<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendorId = Auth::id(); // جلب معرف التاجر الحالي
        $categories = Category::where('parent_id', 0)->where('vendor_id', $vendorId)->get();
        return view('Bacckend.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('Bacckend.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ]);

        $category = new Category();
        $category->setTranslations('name', [
            'en' => $request->input('name_en'),
            'ar' => $request->input('name_ar'),
        ]);
        $category->setTranslations('description', [
            'en' => $request->input('description_en'),
            'ar' => $request->input('description_ar'),
        ]);
        $category->vendor_id = Auth::id(); 
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Created successfully');
    }

    public function edit(Category $category)
    {
        return view('Bacckend.categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($request->id);
        $category->update($data);

        return back();
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

    public function deleteSub($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.subcategories')->with('success', 'SubCategory deleted successfully');
    }
}