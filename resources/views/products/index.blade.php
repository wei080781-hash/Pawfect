<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>商品列表</title>
   </head>
   <body>
      <h1>商品列表</h1>
      
      @forelse ($products as $product)
        <article>
           <h2>{{ $product->name }}</h2>
           
           <p>價格：{{ $product->price }}</p>

           <a href="{{ url('/products/' . $product->id) }}">
             查看商品
            </a>
        </article>
      @empty
        <p>目前沒有上架商品。</p>
      @endforelse
      
      {{ $products->links() }}
    </body>
</html>