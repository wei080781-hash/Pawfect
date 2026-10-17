<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('status', true)
            ->get();

        $latestProducts = Product::query()
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->with(['category', 'media'])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        $recommendedProducts = Product::query()
            ->where('is_active', true)
            ->with(['category', 'media'])
            ->withCount('likes')
            ->having('likes_count', '>', 0)
            ->orderByDesc('likes_count')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('home', [
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'recommendedProducts' => $recommendedProducts,
        ]);
    }
}
