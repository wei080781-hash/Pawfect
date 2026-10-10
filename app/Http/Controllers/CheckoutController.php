<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Auth::user()
            ->carts()
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', '購物車是空的，無法進入結帳。');
        }

        foreach ($carts as $cart) {
            $product = $cart->product;

            if (!$product) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', '購物車中有已刪除或不存在的商品，請先移除。');
            }

            if (!$product->is_active) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "商品「{$product->name}」已下架，請先處理。");
            }

            if ($product->stock < 1) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "商品「{$product->name}」目前缺貨，請先處理。");
            }

            if ($cart->quantity < 1 || $cart->quantity > $product->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "商品「{$product->name}」的購買數量無效或庫存不足，請先調整。");
            }
        }

        $items = $carts->map(function ($cart) {
            $product = $cart->product;
            $quantity = (int) $cart->quantity;
            $price = (float) $product->price;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $price * $quantity,
            ];
        });

        $totalAmount = $items->sum('subtotal');

        return view('checkout.index', [
            'items' => $items,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function store()
    {
        try {
            $orders = DB::transaction(function () {
                $user = Auth::user();

                $carts = $user->carts()
                    ->with('product')
                    ->get();

                if ($carts->isEmpty()) {
                    throw new \RuntimeException('購物車是空的，無法結帳。');
                }

                $items = [];

                // 先檢查所有商品，再建立訂單
                foreach ($carts as $cart) {
                    $product = $cart->product;

                    if (!$product) {
                        throw new \RuntimeException(
                            '購物車中的商品不存在。'
                        );
                    }

                    if (!$product->is_active) {
                        throw new \RuntimeException(
                            "商品「{$product->name}」目前已下架，無法結帳。"
                        );
                    }

                    if ($cart->quantity < 1) {
                        throw new \RuntimeException(
                            "商品「{$product->name}」的購買數量無效，請返回購物車調整。"
                        );
                    }

                    if ($product->stock < 1) {
                        throw new \RuntimeException(
                            "商品「{$product->name}」目前缺貨，無法結帳。"
                        );
                    }

                    if ($product->stock < $cart->quantity) {
                        throw new \RuntimeException(
                            "商品「{$product->name}」庫存不足，目前庫存：{$product->stock}。"
                        );
                    }

                    $price = (float) $product->price;
                    $quantity = (int) $cart->quantity;

                    $items[] = [
                        'product' => $product,
                        'price' => $price,
                        'quantity' => $quantity,
                        'subtotal' => $price * $quantity,
                    ];
                }

                // 依商品所屬賣家分組
                $itemsBySeller = collect($items)->groupBy(
                    fn ($item) => $item['product']->user_id
                );

                $orders = collect();

                // 每位賣家建立一筆獨立訂單
                foreach ($itemsBySeller as $sellerId => $sellerItems) {
                    $totalAmount = $sellerItems->sum('subtotal');

                    $order = $user->orders()->create([
                        'seller_id' => $sellerId,
                        'status' => 'pending',
                        'total_amount' => $totalAmount,
                    ]);

                    foreach ($sellerItems as $item) {
                        $order->items()->create([
                            'product_id' => $item['product']->id,
                            'product_name' => $item['product']->name,
                            'price' => $item['price'],
                            'quantity' => $item['quantity'],
                            'subtotal' => $item['subtotal'],
                        ]);

                        $item['product']->decrement(
                            'stock',
                            $item['quantity']
                        );
                    }

                    $orders->push($order);
                }

                // 所有訂單成功建立後，清空購物車
                $user->carts()->delete();

                return $orders;
            });

            return view('checkout.success', [
                'orders' => $orders,
            ]);
        } catch (\Throwable $exception) {
            return redirect()
                ->route('checkout.index')
                ->with('error', $exception->getMessage());
        }
    }
}