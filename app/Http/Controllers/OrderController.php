<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * 訂單列表頁面
     * GET /orders
     */
    public function index(): View
    {
        // 取得目前登入會員的訂單，最新在前，分頁 10 筆
        $orders = Auth::user()->orders()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * 訂單詳情頁面
     * GET /orders/{order}
     */
    public function show(Order $order): View
    {
        // 使用 Auth::user()->orders() 確保只能看自己的訂單
        $order = Auth::user()->orders()
            ->with('items')
            ->findOrFail($order->id);
        
        return view('orders.show', compact('order'));
    }

    /**
     * 取消訂單
     * POST /orders/{order}/cancel
     * 第一版先做基本回應，後續再實作完整邏輯
     */
    public function cancel(Order $order): RedirectResponse
    {
        // 第一版先簡單實作，後續再加入庫存恢復等邏輯
        // 目前只顯示「暫不支援」或簡單成功訊息
        
        return redirect()->route('orders.index')
            ->with('success', '取消訂單功能開發中');
    }
}