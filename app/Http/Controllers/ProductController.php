<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 基本查詢：查詢所有已發布的商品（is_active = true），排除已刪除
        $query = Product::where('is_active', true)->whereNull('deleted_at');

        // 根據 filter 調整查詢
        $filter = $request->query('filter', 'all');
        
        if ($filter === 'active') {
            $query->where('is_active', true);
        } elseif ($filter === 'inactive') {
            $query->where('is_active', false);
        }

        $products = $query->latest('created_at')->paginate(20);

        return view('products.index', compact('products', 'filter'));
    }
}