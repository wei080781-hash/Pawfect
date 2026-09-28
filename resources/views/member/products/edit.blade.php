<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('編輯商品') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('my-products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- 商品名稱 --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">商品名稱</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-red-500 @enderror" 
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
    
                    {{-- 商品描述 --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">商品描述</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 商品價格 --}}
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">商品價格</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('price') border-red-500 @enderror" 
                               required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 商品庫存 --}}
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700">商品庫存</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('stock') border-red-500 @enderror" 
                               required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 提交按鈕 --}}
                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            儲存修改
                        </button>
                        <a href="{{ route('my-products.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                            取消
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>