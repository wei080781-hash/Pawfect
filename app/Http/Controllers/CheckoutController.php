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

        $items = $carts->map(function ($cart) {
            $product = $cart->product;

            if (!$product) {
                return null;
            }

            $subtotal = (float) $product->price * $cart->quantity;

            return [
                'product' => $product,
                'quantity' => $cart->quantity,
                'price' => (float) $product->price,
                'subtotal' => $subtotal,
            ];
        })->filter()->values();

        if ($items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', '購物車中的商品目前無法購買。');
        }

        $totalAmount = $items->sum('subtotal');

        return view('checkout.index', [
            'items' => $items,
            'totalAmount' => $totalAmount,
        ]);
    }


    public function store()
{
    try {
        $order = DB::transaction(function () {
            $user = Auth::user();

            $carts = $user->carts()
                ->with('product')
                ->get();

            if ($carts->isEmpty()) {
                throw new \RuntimeException('購物車是空的，無法結帳。');
            }

            $items = [];
            $totalAmount = 0;

            foreach ($carts as $cart) {
                $product = $cart->product;

                if (!$product) {
                    throw new \RuntimeException('購物車中的商品不存在。');
                }

                if (!$product->is_active) {
                    throw new \RuntimeException(
                        "商品「{$product->name}」目前已下架，無法結帳。"
                    );
                }

                if ($product->stock < $cart->quantity) {
                    throw new \RuntimeException(
                        "商品「{$product->name}」庫存不足。"
                    );
                }

                $price = (float) $product->price;
                $quantity = (int) $cart->quantity;
                $subtotal = $price * $quantity;

                $items[] = [
                    'product' => $product,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];

                $totalAmount += $subtotal;
            }

            $order = $user->orders()->create([
                'status' => 'pending',
                'total_amount' => $totalAmount,
            ]);

            foreach ($items as $item) {
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

            $user->carts()->delete();

            return $order;
        });

        return view('checkout.success', [
            'order' => $order,
        ]);
    } catch (\Throwable $exception) {
        return redirect()
            ->route('checkout.index')
            ->with('error', $exception->getMessage());
    }
}
}