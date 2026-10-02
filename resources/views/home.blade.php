<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center">
                    <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Pawfect
                    </p>

                    <h1 class="mt-3 text-4xl font-bold text-gray-900">
                        為毛孩挑選合適的商品
                    </h1>

                    <p class="mt-4 text-lg text-gray-600">
                        探索目前上架中的寵物商品，找到適合你家毛孩的選擇。
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700"
                        >
                            查看商品
                        </a>

                        @guest
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-gray-700"
                            >
                                登入
                            </a>

                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50"
                            >
                                註冊
                            </a>
                        @else
                            <a
                                href="{{ route('orders.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-gray-700"
                            >
                                我的訂單
                            </a>

                            <a
                                href="{{ route('profile.edit') }}"
                                class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50"
                            >
                                會員中心
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>