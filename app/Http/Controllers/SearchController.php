<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchtext = $request->search;

        $products = Product::where('name', 'LIKE', '%' . $searchtext . '%')
            ->orWhere('description', 'LIKE', '%' . $searchtext . '%')
            ->paginate(3);

        return view('frontend.eCommerce.searchP', compact('products'));
    }
}