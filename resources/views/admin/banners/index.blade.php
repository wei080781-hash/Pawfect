@extends('layouts.member')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">首頁輪播圖管理</h1>
            <p class="mt-1 text-sm text-gray-600">
                管理首頁輪播圖片、連結及顯示順序。
            </p>
        </div>

        <a
            href="{{ route('admin.banners.create') }}"
            class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700"
        >
            + 新增輪播圖
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
            <p class="font-semibold">操作未完成，請檢查以下問題：</p>
            <ul class="mt-2 list-inside list-disc text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">順序</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">圖片</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">標題</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">連結網址</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">狀態</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">操作</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($banners as $banner)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $banner->sort_order }}
                        </td>

                        <td class="px-4 py-3">
                            <img
                                src="{{ asset('storage/' . $banner->image_path) }}"
                                alt="{{ $banner->title }}"
                                class="h-16 w-28 rounded border border-gray-200 object-cover"
                            >
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $banner->title }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600">
                            {{ $banner->link_url ?: '未設定' }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            @if ($banner->status)
                                <span class="text-green-700">啟用</span>
                            @else
                                <span class="text-gray-500">停用</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a
                                    href="{{ route('admin.banners.edit', $banner) }}"
                                    class="text-sm font-medium text-blue-700 hover:text-blue-900"
                                >
                                    編輯
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.banners.destroy', $banner) }}"
                                    onsubmit="return confirm('確定要刪除這張輪播圖嗎？刪除後無法復原。');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-700 hover:text-red-900"
                                    >
                                        刪除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            目前沒有輪播圖資料。
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
