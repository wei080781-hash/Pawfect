<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'introduction' => 'nullable|string',
            'images' => 'required|array|min:3|max:6',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'video' => 'nullable|file|mimes:mp4|max:102400',
        ], [
            'images.required' => '請至少上傳 3 張商品圖片。',
            'images.min' => '商品圖片至少需要 3 張。',
            'images.max' => '商品圖片最多只能上傳 6 張。',
            'images.*.image' => '商品圖片必須是有效的圖片檔案。',
            'images.*.mimes' => '商品圖片僅支援 JPG、PNG、WebP 格式。',
            'images.*.max' => '單張商品圖片不可超過 5 MB。',
            'video.mimes' => '商品影片僅支援 MP4 格式。',
            'video.max' => '商品影片不可超過 100 MB。',
        ]);
    
        $user = auth()->user();
        $storedPaths = [];
    
        try {
            DB::transaction(function () use (
                $user,
                $validated,
                $request,
                &$storedPaths
            ) {
                $product = $user->products()->create([
                    'name' => $validated['name'],
                    'price' => $validated['price'],
                    'stock' => $validated['stock'],
                    'description' => $validated['description'] ?? null,
                    'introduction' => $validated['introduction'] ?? null,
                    'is_active' => false,
                ]);
    
                foreach ($request->file('images', []) as $index => $image) {
                    $path = $image->store(
                        'products/' . $product->id . '/images',
                        'public'
                    );
    
                    if ($path === false) {
                        throw new \RuntimeException('商品圖片儲存失敗。');
                    }
    
                    $storedPaths[] = $path;
    
                    $product->media()->create([
                        'type' => 'image',
                        'path' => $path,
                        'sort_order' => $index,
                    ]);
                }
    
                if ($request->hasFile('video')) {
                    $video = $request->file('video');
    
                    $path = $video->store(
                        'products/' . $product->id . '/videos',
                        'public'
                    );
    
                    if ($path === false) {
                        throw new \RuntimeException('商品影片儲存失敗。');
                    }
    
                    $storedPaths[] = $path;
    
                    $product->media()->create([
                        'type' => 'video',
                        'path' => $path,
                        'sort_order' => 0,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($storedPaths);
    
            report($exception);
    
            return back()
                ->withInput($request->except(['images', 'video']))
                ->withErrors([
                    'images' => '商品建立或媒體儲存失敗，請確認儲存空間後再試。',
                ]);
        }
    
        return redirect()
            ->route('my-products.index')
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
