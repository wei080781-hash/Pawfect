<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // 取得 filter 參數，預設是 'all'
        $filter = $request->query('filter', 'all');

       // 基本查詢：只查自己的商品，排除已刪除
       $query = $user->products()->whereNull('deleted_at');

       // 根據 filter 調整查詢
       if ($filter === 'active') {
         $query->where('is_active', true);
        } elseif ($filter === 'inactive') {
             $query->where('is_active', false);
        }

        $products = $query->latest('created_at')->paginate(20);

        return view('member.products.index', compact('products', 'filter'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 驗證表單資料
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // 建立商品（預設下架）
        $user = auth()->user();
        $user->products()->create($validated);

        // 導向回商品列表
        return redirect()->route('my-products.index')
        ->with('success', '商品建立成功！');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $user = auth()->user();
       $product = $user->products()->findOrFail($id);
    
       return view('member.products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        $product = $user->products()->findOrFail($id);

        // 驗證表單資料
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // 更新商品
        $product->update($validated);

        // 導向回商品列表
        return redirect()->route('my-products.index')
            ->with('success', '商品更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $product = $user->products()->findOrFail($id);

        // 軟刪除
        $product->delete();

        return redirect()->route('my-products.index')
           ->with('success', '商品已移至回收筒！'); 
    }

    /**
        * Display trashed products.
    */

    public function trashed()
    {
        $user = auth()->user();

        // 只查自己的已刪除商品
        $products = $user->products()
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate(20);

        return view('member.products.trashed', compact('products'));
    }

    /**
        * Restore a trashed product.
    */
    public function restore(string $id)
    {
        $user = auth()->user();
        $product = $user->products()->withTrashed()->findOrFail($id);

        // 還原商品
        $product->restore();

        return redirect()->route('my-products.trashed')
            ->with('success', '商品已還原！');
    }

    /**
        * Permanently delete a trashed product.
    */

    public function forceDelete(string $id)
    {
        $user = auth()->user();
        $product = $user->products()->withTrashed()->findOrFail($id);

        // 永久刪除
        $product->forceDelete();

        return redirect()->route('my-products.trashed')
        ->with('success', '商品已永久刪除！');
    }

    /**
        * Toggle product status (active/inactive).
    */
    public function toggleStatus(string $id)
    {
        $user = auth()->user();
        $product = $user->products()->findOrFail($id);

        // 切換狀態
        $product->update([
            'is_active' => !$product->is_active
        ]);

        return redirect()->route('my-products.index', ['filter' => request('filter', 'all')])
            ->with('success', $product->is_active ? '商品已上架！' : '商品已下架！');
    }
}
