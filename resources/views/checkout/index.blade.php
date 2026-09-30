<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            結帳確認
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">
                        結帳確認
                    </h1>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-3 text-left">商品名稱</th>
                                    <th class="px-4 py-3 text-right">單價</th>
                                    <th class="px-4 py-3 text-right">數量</th>
                                    <th class="px-4 py-3 text-right">小計</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="border-t border-gray-200">
                                        <td class="px-4 py-3">
                                            {{ $item['product']->name }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            {{ number_format($item['price'], 2) }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            {{ $item['quantity'] }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            {{ number_format($item['subtotal'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr class="border-t-2 border-gray-400">
                                    <th colspan="3" class="px-4 py-3 text-right">
                                        總計
                                    </th>
                                    <th class="px-4 py-3 text-right">
                                        {{ number_format($totalAmount, 2) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <a
                            href="{{ route('cart.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                        >
                            返回購物車
                        </a>

                        <form method="POST" action="{{ route('checkout.store') }}">
                            @csrf

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                確認結帳
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>