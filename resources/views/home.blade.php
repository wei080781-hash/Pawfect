<x-app-layout>

    <!-- 首頁內容 -->
    <div class="pb-24">

        
        
        
        <!-- 輪播 Banner -->
        <section class="w-full bg-gray-100 py-6">
            <div class="relative h-[280px] w-full overflow-hidden bg-gray-200 sm:h-[380px] lg:h-[460px]">

                @forelse ($banners as $banner)
                    <div
                        class="absolute inset-0 flex items-center justify-center transition-transform duration-700 ease-in-out"
                        data-banner-slide
                        style="transform: translateX({{ $loop->first ? '0%' : '100%' }});"
                    >
                        @if ($banner->link_url)
                            <a
                                href="{{ $banner->link_url }}"
                                class="flex h-full w-full items-center justify-center"
                                aria-label="{{ $banner->title }}"
                            >
                                <img
                                    src="{{ asset('storage/' . $banner->image_path) }}"
                                    alt="{{ $banner->title }}"
                                    class="h-full w-full object-contain"
                                >
                            </a>
                        @else
                            <img
                                src="{{ asset('storage/' . $banner->image_path) }}"
                                alt="{{ $banner->title }}"
                                class="h-full w-full object-contain"
                            >
                        @endif
                    </div>
                @empty
                    <div class="flex h-full items-center justify-center">
                        <span class="text-lg font-semibold text-gray-500">
                            目前沒有啟用的輪播圖片
                        </span>
                    </div>
                @endforelse

                <!-- 左側箭頭：外框內側 -->
                <button
                    type="button"
                    class="absolute left-4 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow-md hover:bg-white sm:left-6 sm:h-12 sm:w-12"
                    aria-label="上一張"
                >
                    <span class="text-3xl leading-none">‹</span>
                </button>

                <!-- 右側箭頭：外框內側 -->
                <button
                    type="button"
                    class="absolute right-4 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow-md hover:bg-white sm:right-6 sm:h-12 sm:w-12"
                    aria-label="下一張"
                >
                    <span class="text-3xl leading-none">›</span>
                </button>

            </div>
        </section>




        <!-- 新品上架 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                新品上架
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @forelse ($latestProducts as $product)
                    <a
                        href="{{ route('products.show', $product->id) }}"
                        class="bg-white rounded-lg shadow-sm overflow-hidden block hover:shadow-md transition"
                    >
                        <!-- 商品圖片 -->
                        <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                            @php
                                $storage = \Illuminate\Support\Facades\Storage::disk('public');
                                $image = $product->media->first(
                                    function ($media) use ($storage) {
                                        return $media->type === 'image'
                                            && $storage->exists($media->path);
                                    }
                                );
                            @endphp

                            @if ($image)
                                <img
                                    src="{{ $storage->url($image->path) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >
                            @else
                               <span class="text-gray-400">暫無商品圖片</span>
                            @endif
                        </div>

                        <!-- 商品資訊 -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2">
                                {{ $product->name }}
                            </h3>

                            <p class="mt-3 font-bold text-gray-900">
                               ${{ number_format((float) $product->price, 0) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-8 text-center text-gray-500">
                        目前沒有新品上架
                    </div>
                @endforelse

            </div>

        </section>


        <!-- 推薦商品 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                推薦商品
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @forelse ($recommendedProducts as $product)
            <a
                href="{{ route('products.show', $product->id) }}"
                class="bg-white rounded-lg shadow-sm overflow-hidden block hover:shadow-md transition"
            >
                <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                    @php
                        $storage = \Illuminate\Support\Facades\Storage::disk('public');

                        $image = $product->media->first(
                            function ($media) use ($storage) {
                                return $media->type === 'image'
                                    && $storage->exists($media->path);
                            }
                        );
                    @endphp

                    @if ($image)
                        <img
                            src="{{ $storage->url($image->path) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    @else
                        <span class="text-gray-400">暫無商品圖片</span>
                    @endif
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 line-clamp-2">
                        {{ $product->name }}
                    </h3>

                    <p class="mt-3 font-bold text-gray-900">
                        ${{ number_format((float) $product->price, 0) }}
                    </p>

                    <p class="mt-2 text-sm text-gray-500">
                        ♥ {{ $product->likes_count }} 個讚
                    </p>
                </div>
            </a>
                @empty
                    <div class="col-span-full py-8 text-center text-gray-500">
                        目前沒有推薦商品
                    </div>
                @endforelse
            </div>

        </section>

    </div>


    <!-- 返回頂部 -->
    <button
        type="button"
        class="fixed right-5 bottom-24 z-40 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600"
        aria-label="返回頂部"
    >
        ↑
    </button>
    @include('layouts.partials.bottom-navigation')

</x-app-layout>