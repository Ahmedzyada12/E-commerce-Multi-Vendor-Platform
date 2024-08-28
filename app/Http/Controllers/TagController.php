<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::get();
        return view('Bacckend.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Tag::create($data);
        return redirect()->route('tags')->with('success', 'tags add successfully');
    }
    public function create()
    {
        return view('Bacckend.tags.create');
    }
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags')->with('success', 'tags deleted successfully');
    }
}