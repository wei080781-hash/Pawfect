<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <!-- 頁面標題 -->
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                購物車
            </h1>

            <!-- 成功訊息 -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 錯誤訊息 -->
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- 購物車內容 -->
            @if($carts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- 購物車表格 -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        商品名稱
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        單價
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        數量
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        小計
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        操作
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($carts as $cart)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('products.show', $cart->product) }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $cart->product->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($cart->product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input 
                                                    type="number" 
                                                    name="quantity" 
                                                    value="{{ $cart->quantity }}" 
                                                    min="1" 
                                                    max="{{ $cart->product->stock }}"
                                                    class="w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                >
                                                <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                                    更新
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($cart->product->price * $cart->quantity, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <form action="{{ route('cart.remove', $cart) }}" method="POST" onsubmit="return confirm('確定要從購物車移除此商品？')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    移除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- 總計 -->
                        <div class="mt-6 pt-6 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-700">
                                    總計：
                                </span>
                                <span class="text-2xl font-bold text-indigo-600">
                                    ${{ number_format($total, 2) }}
                                </span>
                            </div>

                            <!-- 結帳按鈕（尚未實作） -->
                            <div class="mt-4 text-right">
                                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 disabled:bg-gray-400" disabled>
                                    前往結帳（尚未實作）
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- 購物車是空的 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-gray-500 mb-4">
                            購物車目前是空的
                        </p>
                        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            前往商品列表
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>