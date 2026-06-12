<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $totalRevenue  = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();

        $recentOrders = Order::with('items')
            ->latest()
            ->take(10)
            ->get();

        $monthlySales = Order::selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->where('status', '!=', 'cancelled')
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->orderByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'recentOrders',
            'monthlySales'
        ));
    }
}