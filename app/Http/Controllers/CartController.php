<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * 顯示購物車頁面
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('cart.index', compact('carts', 'total'));
    }

    /**
     * 加入購物車
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        // 檢查庫存
        if ($product->stock < $quantity) {
            return back()->with('error', '庫存不足');
        }

        // 檢查購物車是否已有此商品
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // 更新數量
            $newQuantity = $cart->quantity + $quantity;
            
            // 再次檢查庫存
            if ($product->stock < $newQuantity) {
                return back()->with('error', '庫存不足');
            }

            $cart->update(['quantity' => $newQuantity]);
        } else {
            // 新增購物車項目
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', '已加入購物車');
    }

    /**
     * 更新購物車商品數量
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        // 檢查庫存
        if ($cart->product->stock < $quantity) {
            return back()->with('error', '庫存不足');
        }

        $cart->update(['quantity' => $quantity]);

        return back()->with('success', '已更新數量');
    }

    /**
     * 從購物車移除商品
     */
    public function remove(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', '已從購物車移除');
    }
}
