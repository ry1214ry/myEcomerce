<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners        = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $categories     = Category::where('is_active', true)->withCount('products')->orderBy('sort_order')->take(6)->get();
        $featuredProducts  = Product::active()->featured()->with(['category', 'brand'])->take(8)->get();
        $newArrivals       = Product::active()->newArrivals()->with(['category', 'brand'])->latest()->take(8)->get();
        $bestSellers       = Product::active()->bestSellers()->with(['category', 'brand'])->take(8)->get();
        $brands            = Brand::where('is_active', true)->take(8)->get();

        return view('frontend.home', compact(
            'banners', 'categories', 'featuredProducts',
            'newArrivals', 'bestSellers', 'brands'
        ));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}