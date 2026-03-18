<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'title'  => 'nullable|string|max:255',
            'body'   => 'nullable|string|max:2000',
        ]);

        // Check if user already reviewed
        $existing = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'product_id' => $product->id,
            'user_id'    => auth()->id(),
            'rating'     => $request->rating,
            'title'      => $request->title,
            'body'       => $request->body,
        ]);

        return back()->with('success', 'Review submitted! It will be visible after approval.');
    }
}