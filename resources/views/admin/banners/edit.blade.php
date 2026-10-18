
@extends('layouts.member')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="{{ route('admin.banners.index') }}"
           class="text-sm text-gray-600 hover:text-gray-900">
            ← 返回輪播圖列表
        </a>

        <h1 class="mt-3 text-2xl font-bold text-gray-900">
            編輯首頁輪播圖
        </h1>
    </div>

    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
            <p class="font-semibold">請修正以下欄位：</p>
            <ul class="mt-2 list-inside list-disc text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.banners.update', $banner) }}"
          enctype="multipart/form-data"
          class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="mb-1 block text-sm font-medium text-gray-700">
                輪播圖標題 <span class="text-red-600">*</span>
            </label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title', $banner->title) }}"
                maxlength="255"
                required
                class="w-full rounded-lg border border-gray-300 px-3 py-2"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">
                目前圖片
            </label>
            <img
                src="{{ asset('storage/' . $banner->image_path) }}"
                alt="{{ $banner->title }}"
                class="mb-3 h-32 w-56 rounded border border-gray-200 object-cover"
            >

            <label for="image" class="mb-1 block text-sm font-medium text-gray-700">
                更換圖片（選填）
            </label>
            <input
                id="image"
                name="image"
                type="file"
                accept=".jpg,.jpeg,.png,.webp"
                class="w-full rounded-lg border border-gray-300 px-3 py-2"
            >
            <p class="mt-1 text-xs text-gray-500">
                支援 JPG、JPEG、PNG、WebP，檔案大小不可超過 5 MB。不選擇新圖片則保留原圖。
            </p>
        </div>

        <div>
            <label for="link_url" class="mb-1 block text-sm font-medium text-gray-700">
                點擊圖片後前往的網址
            </label>
            <input
                id="link_url"
                name="link_url"
                type="url"
                value="{{ old('link_url', $banner->link_url) }}"
                maxlength="255"
                placeholder="https://example.com"
                class="w-full rounded-lg border border-gray-300 px-3 py-2"
            >
        </div>

        <div>
            <label for="sort_order" class="mb-1 block text-sm font-medium text-gray-700">
                顯示順序 <span class="text-red-600">*</span>
            </label>
            <input
                id="sort_order"
                name="sort_order"
                type="number"
                min="0"
                value="{{ old('sort_order', $banner->sort_order) }}"
                required
                class="w-full rounded-lg border border-gray-300 px-3 py-2"
            >
            <p class="mt-1 text-xs text-gray-500">數字越小，顯示越前面。</p>
        </div>

        <div>
            <label for="status" class="mb-1 block text-sm font-medium text-gray-700">
                顯示狀態 <span class="text-red-600">*</span>
            </label>
            <select
                id="status"
                name="status"
                required
                class="w-full rounded-lg border border-gray-300 px-3 py-2"
            >
                <option value="1" @selected((string) old('status', (string) (int) $banner->status) === '1')>
                    啟用
                </option>
                <option value="0" @selected((string) old('status', (string) (int) $banner->status) === '0')>
                    停用
                </option>
            </select>
        </div>

        <div class="flex flex-wrap justify-end gap-3 border-t border-gray-200 pt-5">
            <a href="{{ route('admin.banners.index') }}"
               class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                取消
            </a>

            <button type="submit"
                    class="rounded-lg bg-gray-900 px-5 py-2 text-white hover:bg-gray-700">
                儲存修改
            </button>
        </div>
    </form>

</div>
@endsection
