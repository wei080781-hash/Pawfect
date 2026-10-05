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


    <!-- 固定底部導覽 -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200">

        <div class="max-w-7xl mx-auto h-16 grid grid-cols-3">

            <!-- 分類 -->
            <button
                type="button"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <span class="text-xs">
                    分類
                </span>
            </button>


            <!-- 購物車 -->
            <button
                type="button"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2h12m-7 4a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"
                    />
                </svg>

                <span class="text-xs">
                    購物車
                </span>
            </button>


            <!-- 登入 -->
            <button
                type="button"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0zm4.5 8.5A9 9 0 0012 21a9 9 0 00-7.5-1.5"
                    />
                </svg>

                <span class="text-xs">
                    登入
                </span>
            </button>

        </div>

    </nav>

</x-app-layout>
