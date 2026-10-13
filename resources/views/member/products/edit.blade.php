@extends('layouts.member')

@section('content')

<div class="space-y-6">

    <div class="bg-white shadow sm:rounded-lg p-6">

        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            編輯商品
        </h2>

        <form action="{{ route('my-products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- 商品名稱 --}}
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                >
                    商品名稱
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $product->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-red-500 @enderror"
                    required
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- 商品規格 --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">
                    商品規格
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('description') border-red-500 @enderror"
                >{{ old('description', $product->description) }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 商品介紹文字 --}}
            <div class="mb-4">
                <label for="introduction" class="block text-sm font-medium text-gray-700">
                    商品介紹文字
                </label>

                <textarea
                    name="introduction"
                    id="introduction"
                    rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('introduction') border-red-500 @enderror"
                >{{ old('introduction', $product->introduction) }}</textarea>

                @error('introduction')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 新增商品圖片 --}}
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700">
                    新增商品圖片（最多 6 張）
                </label>

                <input
                    type="file"
                    name="images[]"
                    id="images"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    multiple
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('images') border-red-500 @enderror @error('images.*') border-red-500 @enderror"
                >

                <p class="text-sm text-gray-500 mt-1">
                    支援 JPG、PNG、WebP。選取新圖片時，原有圖片的保留與移除將由後端功能處理。
                </p>

                @error('images')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                @error('images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 新增或替換商品影片 --}}
            <div class="mb-4">
                <label for="video" class="block text-sm font-medium text-gray-700">
                    新增或替換商品影片（最多 1 部，單檔上限 100 MB）
                </label>

                <input
                    type="file"
                    name="video"
                    id="video"
                    accept=".mp4,video/mp4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('video') border-red-500 @enderror"
                >

                <p class="text-sm text-gray-500 mt-1">
                    支援 MP4。不選擇新影片時，預期保留原有影片。
                </p>

                @error('video')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 商品價格 --}}
            <div class="mb-4">
                <label
                    for="price"
                    class="block text-sm font-medium text-gray-700"
                >
                    商品價格
                </label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    value="{{ old('price', $product->price) }}"
                    step="0.01"
                    min="0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('price') border-red-500 @enderror"
                    required
                >

                @error('price')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- 商品庫存 --}}
            <div class="mb-4">
                <label
                    for="stock"
                    class="block text-sm font-medium text-gray-700"
                >
                    商品庫存
                </label>

                <input
                    type="number"
                    name="stock"
                    id="stock"
                    value="{{ old('stock', $product->stock) }}"
                    min="0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('stock') border-red-500 @enderror"
                    required
                >

                @error('stock')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- 提交按鈕 --}}
            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    儲存修改
                </button>

                <a
                    href="{{ route('my-products.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
                >
                    取消
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
