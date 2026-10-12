@extends('layouts.member')
   @section('content') 
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                賣家訂單
            </h1>

            @if($orders->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        訂單編號
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        買家
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        建立時間
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        訂單金額
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        狀態
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                        商品項目數
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->buyer_name ?? $order->user?->name ?? '未知買家' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->created_at->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($order->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->items->count() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500 mb-4">
                        目前沒有屬於你的訂單
                    </p>
                    <a href="{{ route('my-products.index') }}"
                       class="text-indigo-600 hover:text-indigo-900">
                        前往我的商品
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection