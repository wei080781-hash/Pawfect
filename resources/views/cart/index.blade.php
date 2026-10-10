
<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                購物車
            </h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($carts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @php
                            $hasInvalidItems = $carts->contains(function ($cart) {
                                return !$cart->product
                                    || !$cart->product->is_active
                                    || $cart->quantity < 1
                                    || $cart->quantity > $cart->product->stock;
                            });
                        @endphp

                        @if($hasInvalidItems)
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded mb-4">
                                購物車中有商品已下架、已刪除或庫存不足。這些商品會保留在購物車中，但必須先處理異常商品才能結帳。
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">商品名稱</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">單價</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">數量</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">小計</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($carts as $cart)
                                        @php
                                            $product = $cart->product;

                                            $itemInvalid = !$product
                                                || !$product->is_active
                                                || $cart->quantity < 1
                                                || $cart->quantity > $product->stock;
                                        @endphp

                                        <tr>
                                            <td class="px-6 py-4">
                                                @if(!$product)
                                                    <span class="text-red-600">
                                                        商品已不存在或已刪除
                                                    </span>
                                                @elseif(!$product->is_active)
                                                    <span class="text-red-600">
                                                        {{ $product->name }}（已下架）
                                                    </span>
                                                @else
                                                    <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-900">
                                                        {{ $product->name }}
                                                    </a>

                                                    <p class="mt-1 text-sm text-gray-500">
                                                        賣家：{{ $product->user?->name ?? '未知賣家' }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($product)
                                                    ${{ number_format($product->price, 2) }}
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($product && $product->is_active)
                                                    <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex items-center gap-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input
                                                            type="number"
                                                            name="quantity"
                                                            value="{{ $cart->quantity }}"
                                                            min="1"
                                                            max="{{ $product->stock }}"
                                                            required
                                                            class="w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                        >
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                                            更新
                                                        </button>
                                                    </form>
                                                @else
                                                    {{ $cart->quantity }}
                                                @endif


                                                @if($product && $product->is_active && $product->stock < 1)
                                                    <p class="text-sm text-red-600 mt-1">
                                                        商品缺貨，目前庫存：{{ $product->stock }}
                                                    </p>
                                                @elseif($product && $product->is_active && $cart->quantity > $product->stock)
                                                    <p class="text-sm text-red-600 mt-1">
                                                        庫存不足，目前庫存：{{ $product->stock }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($product)
                                                    ${{ number_format($product->price * $cart->quantity, 2) }}
                                                @else
                                                    —
                                                @endif
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
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-700">
                                    總計：
                                </span>
                                <span class="text-2xl font-bold text-indigo-600">
                                    ${{ number_format($total, 2) }}
                                </span>
                            </div>

                            <div class="mt-4 text-right">
                                @if($hasInvalidItems)
                                    <button type="button" disabled class="inline-block bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed">
                                        暫時無法結帳
                                    </button>
                                @else
                                    <a href="{{ route('checkout.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                                        前往結帳
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
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