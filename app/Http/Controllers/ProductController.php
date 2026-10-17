<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductLike;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * 公開商品列表、動物專區首頁及分類商品列表。
     */
    
public function index(Request $request)
{
    $filter = $request->query('filter', 'all');
    $animalSlug = $request->query('animal');
    $categorySlug = $request->query('category');

    // 公開商品只顯示已上架且未刪除的商品。
    $baseQuery = Product::query()
        ->where('is_active', true)
        ->whereNull('deleted_at');

    $animal = null;
    $selectedCategory = null;
    $latestProducts = collect();
    $sections = collect();
    $animalSections = collect();

    // 保留既有的單一分類網址。
    if ($categorySlug !== null) {
        $selectedCategory = Category::query()
            ->where('slug', $categorySlug)
            ->whereNotNull('parent_id')
            ->where('status', true)
            ->firstOrFail();

        $products = (clone $baseQuery)
            ->where('category_id', $selectedCategory->id)
            ->with(['category', 'media'])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(6)
            ->withQueryString();

        return view('products.index', compact(
            'products',
            'filter',
            'animal',
            'sections',
            'latestProducts',
            'selectedCategory',
            'animalSections'
        ));
    }

    // 取得所有啟用中的動物主分類與子分類。
    $animals = Category::query()
        ->whereNull('parent_id')
        ->where('status', true)
        ->with([
            'children' => function ($query) {
                $query->where('status', true);
            },
        ])
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    // 取得最新上架商品。
    $latestProducts = (clone $baseQuery)
        ->with(['category', 'media'])
        ->withCount('likes')
        ->orderByDesc('created_at')
        ->orderByDesc('id')
        ->limit(4)
        ->get();

    // 建立每個動物專區及其子分類商品。
    $animalSections = $animals->map(function ($animalCategory) use ($baseQuery) {
        $categoryIds = $animalCategory->children->pluck('id');

        $animalProducts = (clone $baseQuery)
            ->whereIn('category_id', $categoryIds)
            ->with(['category', 'media'])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        $categorySections = $animalCategory->children->map(
            function ($category) use ($baseQuery) {
                $products = (clone $baseQuery)
                    ->where('category_id', $category->id)
                    ->with(['category', 'media'])
                    ->withCount('likes')
                    ->orderByDesc('created_at')
                    ->orderByDesc('id')
                    ->limit(4)
                    ->get();

                return [
                    'category' => $category,
                    'products' => $products,
                ];
            }
        );

        return [
            'animal' => $animalCategory,
            'products' => $animalProducts,
            'sections' => $categorySections,
        ];
    });

    // 保留原有的 $products 分頁資料，避免其他既有功能失效。
    $products = (clone $baseQuery)
        ->with(['category', 'media'])
        ->withCount('likes')
        ->orderByDesc('created_at')
        ->orderByDesc('id')
        ->paginate(20)
        ->withQueryString();

    // 保留既有動物專區網址的查詢結果。
    if ($animalSlug !== null) {
        $animal = $animals->firstWhere('slug', $animalSlug);

        if (!$animal) {
            abort(404);
        }

        $animalSection = $animalSections->firstWhere(
            'animal.id',
            $animal->id
        );

        $sections = $animalSection['sections'] ?? collect();

        $products = (clone $baseQuery)
            ->whereIn('category_id', $animal->children->pluck('id'))
            ->with(['category', 'media'])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $latestProducts = (clone $baseQuery)
            ->whereIn('category_id', $animal->children->pluck('id'))
            ->with(['category', 'media'])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(4)
            ->get();
    }

    return view('products.index', compact(
        'products',
        'filter',
        'animal',
        'sections',
        'latestProducts',
        'selectedCategory',
        'animalSections'
    ));
}


    /**
        * 顯示單一商品詳情。
    */
    public function show(Product $product)
    {
        if (!$product->is_active || $product->deleted_at) {
            abort(404);
        }

        $product->load(['media', 'category']);
        $product->loadCount('likes');

        $isLiked = auth()->check()
            ? $product->likes()
                ->where('user_id', auth()->id())
                ->exists()
            : false;

        return view('products.show', compact('product', 'isLiked'));
    }

    /**
        * 切換商品的點讚狀態。
    */
    public function toggleLike(Product $product)
    {
        // 不允許對未上架或已刪除的商品點讚。
        if (!$product->is_active || $product->deleted_at) {
            abort(404);
        }

        $userId = auth()->id();

        // 已點讚就取消，尚未點讚就新增。
        $like = ProductLike::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($like) {
            $like->delete();

            return back()->with('success', '已取消點讚。');
        }

        ProductLike::create([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        return back()->with('success', '點讚成功。');
    }
}
