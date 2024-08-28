<?php

namespace App\Http\Controllers\apicontroller;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        return response()->json($sizes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'size' => 'required|string|max:255',
        ]);
        $size = Size::create($data);
        return response()->json(['message' => 'Size created successfully', 'size' => $size], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $size = Size::findOrFail($id);
        return response()->json($size, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'size' => 'required|string|max:255',
        ]);
        $size = Size::findOrFail($id);
        $size->update($data);
        return response()->json(['message' => 'Size updated successfully', 'size' => $size], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return response()->json(['message' => 'Size deleted successfully'], 200);
    }
}