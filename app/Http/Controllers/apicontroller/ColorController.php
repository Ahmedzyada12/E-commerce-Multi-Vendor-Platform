<?php

namespace App\Http\Controllers\apicontroller;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return response()->json($colors, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);
        $color = Color::create($data);
        return response()->json(['message' => 'Color created successfully', 'color' => $color], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $color = Color::findOrFail($id);
        return response()->json($color, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);
        $color = Color::findOrFail($id);
        $color->update($data);
        return response()->json(['message' => 'Color updated successfully', 'color' => $color], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return response()->json(['message' => 'Color deleted successfully'], 200);
    }
}