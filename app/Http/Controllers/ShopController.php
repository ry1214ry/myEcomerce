<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['category', 'brand']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->whereHas('brand', fn($q) => $q->where('slug', $request->brand));
        }

        // Price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort
        switch ($request->sort) {
            case 'price_asc':  $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'newest':     $query->latest(); break;
            case 'popular':    $query->orderBy('views', 'desc'); break;
            default:           $query->latest(); break;
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands     = Brand::where('is_active', true)->withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories', 'brands'));
    }

    public function byCategory($slug)
    {
        $category   = Category::where('slug', $slug)->firstOrFail();
        $products   = Product::active()->where('category_id', $category->id)
                        ->with(['category', 'brand'])->paginate(12);
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands     = Brand::where('is_active', true)->withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories', 'brands', 'category'));
    }

    public function byBrand($slug)
    {
        $brand      = Brand::where('slug', $slug)->firstOrFail();
        $products   = Product::active()->where('brand_id', $brand->id)
                        ->with(['category', 'brand'])->paginate(12);
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $brands     = Brand::where('is_active', true)->withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories', 'brands', 'brand'));
    }
}