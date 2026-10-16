<x-app-layout>
    <div class="min-h-screen bg-gray-100 pb-20">
        <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- 頁面標題 --}}
            <header class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    關於 Pawfect
                </h1>
                <p class="mt-2 text-sm leading-6 text-gray-600">
                    用心挑選毛孩生活所需，讓每一次照顧都更簡單。
                </p>
            </header>

            {{-- 品牌介紹 --}}
            <section class="mb-6 rounded-xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="mb-4 text-lg font-bold text-gray-900">
                    Pawfect 寵物生活
                </h2>

                <p class="text-sm leading-7 text-gray-600 sm:text-base">
                    Pawfect 致力於提供毛孩日常生活所需的寵物用品，
                    從食品、零食到玩具與生活用品，
                    希望讓每一位飼主都能更輕鬆地照顧自己的毛孩。
                </p>
            </section>

            {{-- 品牌理念 --}}
            <section class="mb-6 rounded-xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="mb-4 text-lg font-bold text-gray-900">
                    我們的理念
                </h2>

                <p class="text-sm leading-7 text-gray-600 sm:text-base">
                    我們相信，每一隻毛孩都是家庭中重要的一份子。
                    Pawfect 希望透過簡單、清楚的商品分類，
                    幫助飼主快速找到適合毛孩的用品，
                    讓選購寵物用品變得更加方便。
                </p>
            </section>

            {{-- 商品分類介紹 --}}
            <section class="mb-6">
                <h2 class="mb-4 text-lg font-bold text-gray-900">
                    我們的商品分類
                </h2>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <article class="rounded-xl bg-white p-5 text-center shadow-sm">
                        <div class="mb-3 text-3xl" aria-hidden="true">🐶</div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            狗狗專區
                        </h3>
                        <p class="mt-2 text-xs leading-6 text-gray-500">
                            狗狗食品、玩具與日常用品
                        </p>
                    </article>

                    <article class="rounded-xl bg-white p-5 text-center shadow-sm">
                        <div class="mb-3 text-3xl" aria-hidden="true">🐱</div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            貓貓專區
                        </h3>
                        <p class="mt-2 text-xs leading-6 text-gray-500">
                            貓咪食品、玩具與日常用品
                        </p>
                    </article>

                    <article class="rounded-xl bg-white p-5 text-center shadow-sm">
                        <div class="mb-3 text-3xl" aria-hidden="true">🐹</div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            其他動物專區
                        </h3>
                        <p class="mt-2 text-xs leading-6 text-gray-500">
                            其他毛孩的食品與生活用品
                        </p>
                    </article>
                </div>
            </section>

            {{-- 聯絡我們 --}}
            <section class="rounded-xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="mb-4 text-lg font-bold text-gray-900">
                    聯絡我們
                </h2>

                <p class="text-sm leading-7 text-gray-600">
                    如果您對 Pawfect 有任何問題或建議，歡迎與我們聯繫。
                </p>

                <div class="mt-4 space-y-3 text-sm text-gray-700">
                    <p>
                        <span class="font-medium">Email：</span>
                        service@pawfect.example
                    </p>
                    <p>
                        <span class="font-medium">客服專線：</span>
                        暫定
                    </p>
                    <p>
                        <span class="font-medium">服務時間：</span>
                        週一至週五 09:00–18:00
                    </p>
                </div>
            </section>

        </div>
    </div>

    @include('layouts.partials.bottom-navigation')
</x-app-layout>
