<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 pt-3 sm:px-6 lg:px-8">
                {{-- 商品內容區域 --}}
        <section id="product-content" aria-live="polite">
            {{-- 全部商品 --}}
            <div data-animal-section="all">
                <h2 class="mb-4 text-xl font-bold text-gray-800">
                    新品上市
                </h2>

                @include('products.partials.product-grid', [
                    'sectionProducts' => $latestProducts,
                ])

                @foreach ($animalSections as $animalSection)
                    <section class="mt-10">
                        <h2 class="mb-4 text-xl font-bold text-gray-800">
                            {{ $animalSection['animal']->name }}商品
                        </h2>

                        @include('products.partials.product-grid', [
                            'sectionProducts' => $animalSection['products']->take(4),
                        ])

                        @foreach ($animalSection['sections'] as $categorySection)
                            <div class="mt-8">
                                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                                    {{ $categorySection['category']->name }}
                                </h3>

                                @include('products.partials.product-grid', [
                                    'sectionProducts' => $categorySection['products'],
                                ])
                            </div>
                        @endforeach
                    </section>
                @endforeach
            </div>
        </section>
    </div>

{{-- 商品卡片元件 --}}
<template id="product-card-template">
    <article class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <a class="product-card-link block" href="#">
            <div class="aspect-square overflow-hidden bg-gray-100">
                <img
                    class="product-card-image h-full w-full object-cover"
                    src=""
                    alt=""
                    loading="lazy">
            </div>
            <h3 class="product-card-name px-3 py-4 text-center text-sm font-semibold text-gray-800"></h3>
        </a>
    </article>
</template>

@include('layouts.partials.bottom-navigation')

</x-app-layout>