<?php

namespace App\Http\Controllers\apicontroller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = Category::where('parent_id', '!=', 0)->get();
        return response()->json($subCategories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'required|integer|exists:categories,id'
        ]);
        $subCategory = Category::create($data);
        return response()->json(['message' => 'SubCategory created successfully', 'subCategory' => $subCategory], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subCategory = Category::findOrFail($id);
        return response()->json($subCategory, 200);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'required|integer|exists:categories,id'
        ]);
        $subCategory = Category::findOrFail($id);
        $subCategory->update($data);
        return response()->json(['message' => 'SubCategory updated successfully', 'subCategory' => $subCategory], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'SubCategory deleted successfully'], 200);
    }

    public function subCategoryByCategoryId($id)
    {
        $subCats = Category::where('parent_id', $id)->get();
        return response()->json($subCats, 200);
    }

    public function getSubCategory(Request $request)
    {
        $subCats = Category::where('parent_id', $request->id)->get();
        return response()->json($subCats, 200);
    }
}