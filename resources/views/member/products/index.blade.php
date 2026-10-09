@extends('layouts.member')

@section('content')

<div class="space-y-6">

    {{-- 分類導覽 --}}
    <div class="bg-white shadow sm:rounded-lg p-4">
        <div class="flex gap-4">
            <a href="{{ route('my-products.index', ['filter' => 'all']) }}"
                class="px-4 py-2 {{ $filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded">
                全部
            </a>

            <a href="{{ route('my-products.index', ['filter' => 'active']) }}"
                class="px-4 py-2 {{ $filter === 'active' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded">
                上架中
            </a>

            <a href="{{ route('my-products.index', ['filter' => 'inactive']) }}"
                class="px-4 py-2 {{ $filter === 'inactive' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded">
                下架中
            </a>
        </div>
    </div>

    {{-- 商品列表 --}}
    <div class="bg-white shadow sm:rounded-lg p-4">

        <div class="flex justify-between items-center mb-4">

            <h3 class="text-lg font-medium">
                @if($filter === 'all')
                    全部商品
                @elseif($filter === 'active')
                    上架中商品
                @else
                    下架中商品
                @endif
            </h3>

            <div class="flex gap-2">

                {{-- 回收筒連結 --}}
                <a href="{{ route('my-products.trashed') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    回收筒
                </a>

                {{-- 新增商品 --}}
                <a href="{{ route('my-products.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    新增商品
                </a>

            </div>
        </div>

        {{-- 商品列表 --}}
        @if($products->count() > 0)

            <table class="min-w-full divide-y divide-gray-200">

                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">商品名稱</th>
                        <th class="px-4 py-2 text-left">價格</th>
                        <th class="px-4 py-2 text-left">庫存</th>
                        <th class="px-4 py-2 text-left">狀態</th>
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

                                @if($product->is_active)
                                    <span class="text-green-600">上架</span>
                                @else
                                    <span class="text-red-600">下架</span>
                                @endif

                            </td>

                            <td class="px-4 py-2">

                                {{-- 上架 / 下架 --}}
                                <form
                                    action="{{ route('my-products.toggle-status', $product->id) }}"
                                    method="POST"
                                    class="inline mr-2"
                                >
                                    @csrf
                                    @method('PATCH')

                                    @if($product->is_active)

                                        <button
                                            type="submit"
                                            class="text-orange-600 hover:text-orange-800"
                                            onclick="return confirm('確定要下架這個商品嗎？')"
                                        >
                                            下架
                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="text-green-600 hover:text-green-800"
                                            onclick="return confirm('確定要上架這個商品嗎？')"
                                        >
                                            上架
                                        </button>

                                    @endif

                                </form>

                                {{-- 編輯 --}}
                                <a
                                    href="{{ route('my-products.edit', $product->id) }}"
                                    class="text-blue-600 hover:text-blue-800"
                                >
                                    編輯
                                </a>

                                {{-- 刪除 --}}
                                <form
                                    action="{{ route('my-products.destroy', $product->id) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800"
                                        onclick="return confirm('確定要刪除這個商品嗎？')"
                                    >
                                        刪除
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
                目前沒有商品。
            </p>

        @endif

    </div>

</div>

@endsection