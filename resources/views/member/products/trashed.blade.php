@extends('layouts.member')

@section('content')

<div class="space-y-6">

    {{-- 返回商品列表 --}}
    <div class="bg-white shadow sm:rounded-lg p-4">
        <a
            href="{{ route('my-products.index') }}"
            class="text-blue-600 hover:text-blue-800"
        >
            ← 返回商品列表
        </a>
    </div>

    {{-- 已刪除商品列表 --}}
    <div class="bg-white shadow sm:rounded-lg p-4">

        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            回收筒
        </h2>

        <h3 class="text-lg font-medium mb-4">
            已刪除商品
        </h3>

        @if($products->count() > 0)

            <table class="min-w-full divide-y divide-gray-200">

                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">商品名稱</th>
                        <th class="px-4 py-2 text-left">價格</th>
                        <th class="px-4 py-2 text-left">庫存</th>
                        <th class="px-4 py-2 text-left">刪除時間</th>
                        <th class="px-4 py-2 text-left">操作</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($products as $product)

                        <tr>

                            <td class="px-4 py-2">
                                {{ $product->name }}
                            </td>

                            <td class="px-4 py-2">
                                ${{ $product->price }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $product->stock }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $product->deleted_at->format('Y-m-d H:i') }}
                            </td>

                            <td class="px-4 py-2">

                                {{-- 還原 --}}
                                <form
                                    action="{{ route('my-products.restore', $product->id) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="text-green-600 hover:text-green-800 mr-4"
                                    >
                                        還原
                                    </button>
                                </form>

                                {{-- 永久刪除 --}}
                                <form
                                    action="{{ route('my-products.force-delete', $product->id) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('確定要永久刪除這個商品嗎？此操作無法復原。')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800"
                                    >
                                        永久刪除
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            {{-- 分頁 --}}
            <div class="mt-4">
                {{ $products->links() }}
            </div>

        @else

            <p class="text-gray-600">
                回收筒是空的。
            </p>

        @endif

    </div>

</div>

@endsection
