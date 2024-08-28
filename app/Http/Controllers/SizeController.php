<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::get();
        return view('Bacckend.size.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'size' => 'required|string|max:255',
        ]);
        Size::create($data);

        return redirect()->route('sizes')->with('success', 'sizes add successfully');
    }
    public function create()
    {
        return view('Bacckend.size.create');
    }
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->route('sizes')->with('success', 'sizes deleted successfully');
    }
}