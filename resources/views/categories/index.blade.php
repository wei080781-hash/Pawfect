<x-app-layout>

    {{-- 外層：灰色底，讓寬螢幕兩側有留白 --}}
    <div class="min-h-screen bg-gray-200">

        {{-- 內容區：限制最大寬度 940px 並置中 --}}
        <div class="mx-auto w-full max-w-[940px] min-h-screen bg-gray-100">

            <!-- 頁面標題 -->
            <header class="bg-white border-b border-gray-200">
                <div class="h-16 flex items-center px-4">
                    <a
                        href="{{ route('home') }}"
                        class="mr-4 text-gray-600 text-xl hover:text-gray-900"
                        aria-label="返回首頁"
                    >
                        ←
                    </a>

                    <h1 class="text-lg font-bold text-gray-900">
                        Pawfect 商品分類
                    </h1>
                </div>
            </header>

            <!-- 商品分類 -->
            <div class="flex min-h-[calc(100vh-4rem)]">

                <!-- 左側主分類（寬度約 20%，最大 184px） -->
                <aside class="w-1/5 min-w-[112px] max-w-[184px] flex-shrink-0 bg-white border-r border-gray-200">

                    <div class="py-4">

                        <!-- 狗狗專區 -->
                        <button
                            type="button"
                            data-category="dogs"
                            class="w-full px-4 py-4 text-left bg-gray-100 font-semibold text-gray-900"
                        >
                            🐶 狗狗專區 
                        </button>

                        <!-- 貓貓專區 -->
                        <button
                            type="button"
                            data-category="cats"
                            class="w-full px-4 py-4 text-left text-gray-700 hover:bg-gray-100"
                        >
                            🐱 貓貓專區
                        </button>

                        <!-- 其他動物專區 -->
                        <button
                            type="button"
                            data-category="others"
                            class="w-full px-4 py-4 text-left text-gray-700 hover:bg-gray-100"
                        >
                            🐹 其他動物專區
                        </button>

                        <!-- 關於我們 -->
                        <button
                            type="button"
                            data-category="about"
                            class="w-full px-4 py-4 text-left text-gray-700 hover:bg-gray-100"
                        >
                            ℹ️ 關於我們
                        </button>

                    </div>

                </aside>


                <!-- 右側內容 -->
                <main class="flex-1 min-w-0 p-4 sm:p-6">

                    <!-- 狗狗專區 -->
                    <div data-content="dogs">

                    <!-- 新品上市 -->
                    <section class="mb-10">

                        <h2 class="text-lg font-bold text-gray-900 mb-5">
                            ■ 新品上市
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                    <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">
                                            商品圖片
                                        </span>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            狗狗新品 {{ $i }}
                                        </h3>
                                    </div>

                                </div>
                            @endfor

                        </div>

                    </section>


                    <!-- 狗狗商品 -->
                    <section class="mb-10">

                        <h2 class="text-lg font-bold text-gray-900 mb-5">
                            ■ 狗狗商品
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                    <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">
                                            商品圖片
                                        </span>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            狗狗商品 {{ $i }}
                                        </h3>
                                    </div>

                                </div>
                            @endfor

                        </div>

                    </section>


                    <!-- 狗狗飼料 -->
                    <section class="mb-10">

                        <h2 class="text-lg font-bold text-gray-900 mb-5">
                            ■ 狗狗飼料
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                    <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">
                                            商品圖片
                                        </span>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            狗狗飼料 {{ $i }}
                                        </h3>
                                    </div>

                                </div>
                            @endfor

                        </div>

                    </section>

                    <!-- 狗狗玩具 -->
                    <section class="mb-10">

                        <h2 class="text-lg font-bold text-gray-900 mb-5">
                            ■ 狗狗玩具
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                    <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">
                                            商品圖片
                                        </span>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            狗狗玩具 {{ $i }}
                                        </h3>
                                    </div>

                                </div>
                            @endfor

                        </div>

                    </section>


                    <!-- 狗狗零食 -->
                    <section>

                        <h2 class="text-lg font-bold text-gray-900 mb-5">
                            ■ 狗狗零食
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                    <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">
                                            商品圖片
                                        </span>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            狗狗零食 {{ $i }}
                                        </h3>
                                    </div>

                                </div>
                            @endfor

                            </div>

                        </section>

                    </div> <!-- End of 狗狗專區 -->

                   
                    <!-- 貓貓專區 -->
                    <div data-content="cats" class="hidden">

                        <!-- 新品上市 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 新品上市
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                貓咪新品 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 貓咪商品 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 貓咪商品
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                貓咪商品 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 貓咪飼料 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 貓咪飼料
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                貓咪飼料 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>

                        <!-- 貓咪玩具 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 貓咪玩具
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                貓咪玩具 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 貓咪零食 -->
                        <section>

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 貓咪零食
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                貓咪零食 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>

                    </div> <!-- End of 貓貓專區 -->

                    <!-- 其他動物專區 -->
                    <div data-content="others" class="hidden">

                        <!-- 新品上市 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 新品上市
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                其他動物新品 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 其他動物商品 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 其他動物商品
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                其他動物商品 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 其他動物飼料 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 其他動物飼料
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                其他動物飼料 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>

                        <!-- 其他動物玩具 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 其他動物玩具
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                其他動物玩具 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>


                        <!-- 其他動物零食 -->
                        <section>

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 其他動物零食
                            </h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

                                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">
                                                商品圖片
                                            </span>
                                        </div>

                                        <div class="p-3 text-center">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                其他動物零食 {{ $i }}
                                            </h3>
                                        </div>

                                    </div>
                                @endfor

                            </div>

                        </section>

                    </div> <!-- End of 其他動物專區 -->
                    <!-- 關於我們 -->
                    <div data-content="about" class="hidden">

                        <!-- Pawfect 品牌介紹 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 關於 Pawfect
                            </h2>

                            <div class="bg-white rounded-lg shadow-sm p-6">

                                <h3 class="text-base font-semibold text-gray-900 mb-3">
                                    Pawfect 寵物生活
                                </h3>

                                <p class="text-sm leading-7 text-gray-600">
                                    Pawfect 致力於提供毛孩日常生活所需的寵物用品，
                                    從食品、零食到玩具與生活用品，
                                    希望讓每一位飼主都能更輕鬆地照顧自己的毛孩。
                                </p>

                            </div>

                        </section>


                        <!-- 我們的理念 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 我們的理念
                            </h2>

                            <div class="bg-white rounded-lg shadow-sm p-6">

                                <p class="text-sm leading-7 text-gray-600">
                                    我們相信，每一隻毛孩都是家庭中重要的一份子。
                                    Pawfect 希望透過簡單、清楚的商品分類，
                                    幫助飼主快速找到適合毛孩的用品，
                                    讓選購寵物用品變得更加方便。
                                </p>

                            </div>

                        </section>


                        <!-- 商品分類 -->
                        <section class="mb-10">

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 商品分類
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                <div class="bg-white rounded-lg shadow-sm p-5 text-center">
                                    <div class="text-3xl mb-3">
                                        🐶
                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-900">
                                        狗狗專區
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-2">
                                        狗狗食品、玩具與用品
                                    </p>
                                </div>


                                <div class="bg-white rounded-lg shadow-sm p-5 text-center">
                                    <div class="text-3xl mb-3">
                                        🐱
                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-900">
                                        貓貓專區
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-2">
                                        貓咪食品、玩具與用品
                                    </p>
                                </div>


                                <div class="bg-white rounded-lg shadow-sm p-5 text-center">
                                    <div class="text-3xl mb-3">
                                        🐹
                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-900">
                                        其他動物專區
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-2">
                                        其他毛孩的食品與用品
                                    </p>
                                </div>

                            </div>

                        </section>


                        <!-- 聯絡資訊 -->
                        <section>

                            <h2 class="text-lg font-bold text-gray-900 mb-5">
                                ■ 聯絡我們
                            </h2>

                            <div class="bg-white rounded-lg shadow-sm p-6">

                                <p class="text-sm text-gray-600 leading-7">
                                    如果您對 Pawfect 有任何問題或建議，
                                    歡迎與我們聯繫。
                                </p>

                                <div class="mt-4 text-sm text-gray-700 space-y-2">
                                    <p>
                                        📧 Email：service@pawfect.example
                                    </p>

                                    <p>
                                        📞 客服專線：暫定
                                    </p>

                                    <p>
                                        🕐 服務時間：週一至週五 09:00–18:00
                                    </p>
                                </div>

                            </div>

                        </section>

                    </div> <!-- End of 關於我們 -->
                </main>

            </div>

        </div>

    </div>
    {{-- 分類切換 JavaScript --}}
    <script>
        const categoryButtons = document.querySelectorAll('[data-category]');
        const categoryContents = document.querySelectorAll('[data-content]');

        categoryButtons.forEach(button => {
           button.addEventListener('click', () => {
            
              const category = button.dataset.category;
              
              categoryContents.forEach(content => {
                   content.classList.toggle(
                      'hidden',
                      content.dataset.content !== category
                     );
                });
                
                categoryButtons.forEach(item => {
                    item.classList.remove(
                        'bg-gray-100',
                        'font-semibold',
                        'text-gray-900'
                    );
                    item.classList.add('text-gray-700');
                });

                button.classList.add(
                    'bg-gray-100',
                    'font-semibold',
                    'text-gray-900'
                );

                button.classList.remove('text-gray-700');
            });
        });
    </script>    

</x-app-layout>