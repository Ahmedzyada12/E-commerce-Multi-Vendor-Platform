<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->product_id = $productId;
        $review->comment = $request->input('comment');
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function index($productId)
    {
        $product = Product::with(['reviews.user'])->findOrFail($productId);

        $reviews = Review::with('user')->get();

        return view('frontend.eCommerce.productDetails', compact('product', 'reviews'));
    }
    public function view()
    {
        $product = Product::with(['reviews.user'])->get();

        $reviews = Review::with('user')->get();

        return view('Bacckend.review.indexreview', compact('product', 'reviews'));
    }
    public function destroy($reviewId)
    {
        $review = Review::findOrFail($reviewId);

        // // Optional: Check if the authenticated user is allowed to delete this review
        // if (auth()->id() != $review->user_id && !auth()->user()->is_admin) {
        //     return redirect()->back()->with('error', 'You are not authorized to delete this review.');
        // }
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}