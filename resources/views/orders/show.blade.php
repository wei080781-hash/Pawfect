<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <!-- 返回按鈕 -->
            <div class="mb-6">
                <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-900">
                    ← 返回訂單列表
                </a>
            </div>

            <!-- 訂單摘要 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">
                        訂單 #{{ $order->id }}
                    </h1>

                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">建立時間：</span>
                            <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-medium">訂單狀態：</span>
                            <span>{{ $order->status }}</span>
                        </div>
                        <div>
                            <span class="font-medium">訂單總額：</span>
                            <span class="text-lg font-bold text-indigo-600">
                                ${{ number_format($order->total_amount, 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 商品清單表格 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        商品清單
                    </h2>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    商品名稱
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    單價
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    數量
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    小計
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        ${{ number_format($item->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        ${{ number_format($item->subtotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-400">
                                <th colspan="3" class="px-6 py-3 text-right">
                                    總計
                                </th>
                                <th class="px-6 py-3 text-right">
                                    ${{ number_format($order->total_amount, 2) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- 取消訂單按鈕 -->
                    <div class="mt-6">
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('確定要取消此訂單？')">
                            @csrf
                            @method('POST')
                            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
                                取消訂單
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>