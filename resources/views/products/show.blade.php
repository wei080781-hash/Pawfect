
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">

            {{-- 返回商品列表 --}}
            <div class="mb-6">
                <a href="{{ route('products.index') }}"
                   class="text-indigo-600 hover:text-indigo-900">
                    ← 返回商品列表
                </a>
            </div>

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

            {{-- 三個獨立卡片的容器 --}}
            <div class="space-y-6">

                {{-- 區塊一：商品基本訊息與購買操作 --}}
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>
                {{-- 商品點讚資訊 --}}
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span class="text-gray-700">
                        ❤️ 點讚數：{{ $product->likes_count }}
                    </span>

                    @auth
                        <form action="{{ route('products.toggleLike', $product->id) }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg text-white {{ $isLiked ? 'bg-gray-500 hover:bg-gray-600' : 'bg-pink-600 hover:bg-pink-700' }}"
                            >
                                {{ $isLiked ? '取消點讚' : '點讚' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-indigo-600 hover:text-indigo-800 underline">
                            登入後即可點讚
                        </a>
                    @endauth
                </div>
                
                {{-- 商品價格與庫存 --}}
                    <div class="flex flex-wrap items-baseline gap-4 mb-6">
                        <span class="text-4xl font-bold text-indigo-600">
                            ${{ number_format($product->price, 2) }}
                        </span>

                        <span class="text-gray-500">
                            庫存：{{ $product->stock }}
                        </span>
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf

                        <div class="flex flex-wrap items-center gap-4 mb-4">
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
                                {{ $product->stock == 0 ? 'disabled' : '' }}
                            >

                            <span class="text-sm text-gray-500">
                                （庫存：{{ $product->stock }}）
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <button
                                type="submit"
                                class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 disabled:bg-gray-400"
                                {{ $product->stock == 0 ? 'disabled' : '' }}
                            >
                                加入購物車
                            </button>

                            {{-- 目前保留停用狀態 --}}
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
                    </form>
                </div>

                {{-- 區塊二：商品介紹 --}}
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">
                        商品介紹
                    </h2>

                    @php
                        $media = $product->media;
                        $video = $media->firstWhere('type', 'video');
                        $images = $media->where('type', 'image');

                        $storage = \Illuminate\Support\Facades\Storage::disk('public');

                        $videoExists = $video && $storage->exists($video->path);

                        $existingImages = $images->filter(
                            fn ($image) => $storage->exists($image->path)
                        );
                    @endphp

                    {{-- 商品影片：只有實際檔案存在才顯示播放器 --}}
                    @if($videoExists)
                        <div class="mb-6">
                            <video
                                controls
                                preload="metadata"
                                class="w-full max-h-[480px] rounded-lg bg-black"
                            >
                                <source
                                    src="{{ $storage->url($video->path) }}"
                                    type="video/mp4"
                                >
                                您的瀏覽器不支援影片播放。
                            </video>
                        </div>
                    @endif

                    {{-- 商品圖片：只顯示實際存在的圖片 --}}
                    <div class="mb-6">
                        @if($existingImages->isNotEmpty())
                            <div class="flex flex-col gap-4">
                                @foreach($existingImages as $image)
                                    <img
                                        src="{{ $storage->url($image->path) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full rounded-lg object-contain bg-gray-50"
                                        loading="lazy"
                                    >
                                @endforeach
                            </div>
                        @else
                            <div class="flex min-h-40 items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                                暫無商品圖片
                            </div>
                        @endif
                    </div>


                    {{-- 商品介紹文字 --}}
                    <div>
                        <h3 class="text-base font-medium text-gray-700 mb-2">
                            介紹內容
                        </h3>

                        <p class="text-gray-800 whitespace-pre-line">
                            {{ $product->introduction ?: '尚未提供商品介紹。' }}
                        </p>
                    </div>
                </div>

                {{-- 區塊三：商品規格 --}}
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">
                        商品規格
                    </h2>

                    <p class="text-gray-800 whitespace-pre-line">
                        {{ $product->description ?: '尚未提供商品規格。' }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
