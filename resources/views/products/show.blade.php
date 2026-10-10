<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- 返回按鈕 -->
            <div class="mb-6">
                 <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">
                    ← 返回商品列表
                </a>
            </div>

            <!-- 商品卡片 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6">
                        {{-- 成功訊息 --}}
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- 錯誤訊息 --}}
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                    <!-- 商品名稱 -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    <!-- 商品價格與庫存 -->
                    <div class="flex items-baseline gap-4 mb-6">
                        <span class="text-4xl font-bold text-indigo-600">
                            ${{ number_format($product->price, 2) }}
                        </span>
                        <span class="text-gray-500">
                            庫存: {{ $product->stock }}
                        </span>
                    </div>

                    <!-- 商品描述 -->
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">
                            商品描述
                        </h2>
                        <p class="text-gray-800">
                            {{ $product->description }}
                        </p>
                    </div>
                    
                    <!-- 商品資訊 -->
                    <div class="border-t pt-4">
                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">上架狀態：</span>
                                <span class="{{ $product->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->is_active ? '上架中' : '下架中' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium">建立時間：</span>
                                <span>{{ $product->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 加入購物車與購買 -->
                    <div class="mt-8">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="flex items-center gap-4 mb-4">
                             <label for="quantity" class="text-gray-700 font-medium">
                                數量：
                            </label>
                            <input 
                                type="number" 
                                id="quantity" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                max="{{ $product->stock }}"
                                class="w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                    <span class="text-sm text-gray-500">
                        （庫存：{{ $product->stock }}）
                    </span>
                </div>

                <div class="flex gap-4">
                    <button 
            type="submit"
            class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 disabled:bg-gray-400" 
                {{ $product->stock == 0 ? 'disabled' : '' }}
        >
            加入購物車
        </button>
        <button 
            type="button"
            class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 disabled:bg-gray-400"
            disabled
        >
            立即購買
        </button>
    </div>
    @if($product->stock == 0)
       <p class="mt-4 text-red-600 font-medium">
            目前缺貨
        </p>
    @endif 
    </div>
    </div>
</x-app-layout>