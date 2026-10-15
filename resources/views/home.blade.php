<x-app-layout>

    <!-- 首頁內容 -->
    <div class="pb-24">

        <!-- 輪播 Banner -->
        <section class="w-full">
            <div class="relative h-[500px] bg-gray-200 flex items-center justify-center">
                <span class="text-2xl font-semibold text-gray-500">
                    輪播 Banner
                </span>

                <!-- 左右切換按鈕：目前只有畫面 -->
                <button
                    type="button"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-600"
                >
                    ‹
                </button>

                <button
                    type="button"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-600"
                >
                    ›
                </button>

                <!-- Banner 圓點 -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <span class="w-2 h-2 rounded-full bg-gray-800"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                </div>
            </div>
        </section>


        <!-- 新品上架 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                新品上架
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                        <!-- 商品圖片佔位 -->
                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">
                                商品圖片
                            </span>
                        </div>

                        <!-- 商品資訊 -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">
                                新品商品 {{ $i }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                商品簡短介紹
                            </p>

                            <p class="mt-3 font-bold text-gray-900">
                                ${{ 299 + ($i * 100) }}
                            </p>
                        </div>

                    </div>
                @endfor

            </div>

        </section>


        <!-- 推薦商品 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                推薦商品
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @for ($i = 1; $i <= 8; $i++)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                        <!-- 商品圖片佔位 -->
                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">
                                商品圖片
                            </span>
                        </div>

                        <!-- 商品資訊 -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">
                                推薦商品 {{ $i }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                商品簡短介紹
                            </p>

                            <p class="mt-3 font-bold text-gray-900">
                                ${{ 399 + ($i * 100) }}
                            </p>
                        </div>

                    </div>
                @endfor

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