
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            訂單完成
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-green-600 mb-4">
                            訂單已建立
                        </h1>

                        <p class="text-gray-600 mb-6">
                            感謝你的購買，訂單已成功建立。
                        </p>

                        @foreach ($orders as $order)
                            <div class="border-t border-gray-200 py-4 text-left">
                                <h3 class="font-bold text-lg mb-3">
                                    訂單 #{{ $order->id }}
                                </h3>

                                <p class="mb-2">
                                    <span class="font-semibold">訂單編號：</span>
                                    {{ $order->id }}
                                </p>

                                <p class="mb-2">
                                    <span class="font-semibold">賣家：</span>
                                    {{ $order->seller?->name ?? '未知' }}
                                </p>

                                <p class="mb-2">
                                    <span class="font-semibold">訂單狀態：</span>
                                    {{ $order->status }}
                                </p>

                                <p>
                                    <span class="font-semibold">訂單總額：</span>
                                    {{ number_format((float) $order->total_amount, 2) }}
                                </p>
                            </div>
                        @endforeach

                        <div class="mt-6 flex justify-center gap-4">
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                繼續購物
                            </a>

                            <a href="{{ route('orders.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                查看我的訂單
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>