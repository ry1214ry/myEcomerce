<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders   = Order::count();
        $totalProducts = Product::count();
        $totalUsers    = User::where('role', 'customer')->count();
        $totalRevenue  = Order::where('payment_status', 'paid')->sum('total');

        $recentOrders  = Order::with('user')->latest()->take(10)->get();
        $topProducts   = Product::orderBy('views', 'desc')->take(5)->get();

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalOrders', 'totalProducts', 'totalUsers', 'totalRevenue',
            'recentOrders', 'topProducts', 'monthlyRevenue'
        ));
    }
}