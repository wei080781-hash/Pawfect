<div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
    @forelse ($sectionProducts as $product)
        @php
            $storage = \Illuminate\Support\Facades\Storage::disk('public');

            $image = $product->media
              ->first(function ($media) use ($storage) {
                  return $media->type === 'image'
                      && $storage->exists($media->path);
              });
        @endphp

        <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:shadow-md">
            <a
                href="{{ route('products.show', $product) }}"
                class="block">

                <div class="aspect-square overflow-hidden bg-gray-100">
                    @if ($image)
                        <img
                            src="{{ $storage->url($image->path) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover"
                            loading="lazy">
                    @else
                        <div
                            class="flex h-full w-full items-center justify-center text-sm text-gray-400"
                            role="img"
                            aria-label="尚無商品圖片">
                            尚無商品圖片
                        </div>
                    @endif
                </div>

                <h4 class="px-2 pt-3 text-center text-xs font-semibold text-gray-800 sm:text-sm">
                    {{ $product->name }}
                </h4>

                <p class="px-2 pb-4 text-center text-sm font-bold text-rose-600">
                    NT$ {{ number_format((float) $product->price, 0) }}
                </p>

                <p class="px-2 pb-4 text-center text-xs text-gray-500">
                    ♥ {{ $product->likes_count ?? 0 }} 個讚
                </p>

            </a>
        </article>
    @empty
        <p class="col-span-full rounded-lg bg-gray-50 p-5 text-center text-sm text-gray-500">
            目前沒有上架商品。
        </p>
    @endforelse
</div>