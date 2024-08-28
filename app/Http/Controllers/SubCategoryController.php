<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Bacckend.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'parent_id' => 'required|integer|exists:categories,id',
        ]);

        // إنشاء الفئة مع ترجمة الحقول
        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->vendor_id = Auth::id(); // تعيين معرف التاجر الحالي

        // تعيين الترجمات
        $category->setTranslations('name', [
            'en' => $request->input('name_en'),
            'ar' => $request->input('name_ar'),
        ]);

        $category->setTranslations('description', [
            'en' => $request->input('description_en'),
            'ar' => $request->input('description_ar'),
        ]);

        // حفظ الفئة
        $category->save();

        return back()->with('success', 'Sub-category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update(array_merge($data, ['vendor_id' => Auth::id()]));

        return back()->with('success', 'Sub-category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Category::findOrFail($request->id)->delete();
        return back()->with('success', 'Sub-category deleted successfully');
    }

    public function subCategoryByCategoryId($id)
    {
        $subCats = Category::where('parent_id', $id)->get();
        return view('Bacckend.subcategory.index', compact('subCats', 'id'));
    }

    public function getSubCategory(Request $request)
    {
        $categoryId = $request->id;
        $locale = app()->getLocale();

        $subCategories = Category::where('parent_id', $categoryId)->get()->map(function ($category) use ($locale) {
            return [
                'id' => $category->id,
                'name' => $category->getTranslation('name', $locale),
            ];
        });

        return response()->json($subCategories);
    }
}
