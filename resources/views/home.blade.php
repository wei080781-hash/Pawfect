<x-app-layout>

    <!-- 首頁內容 -->
    <div class="pb-24">

        <!-- 輪播 Banner -->
        <section class="w-full">
            <div class="relative h-[500px] bg-gray-200 flex items-center justify-center">
                <span class="text-2xl font-semibold text-gray-500">
                    輪播 Banner
                </span>

                <!-- 左右切換按鈕：目前只有畫面 -->
                <button
                    type="button"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-600"
                >
                    ‹
                </button>

                <button
                    type="button"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-600"
                >
                    ›
                </button>

                <!-- Banner 圓點 -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <span class="w-2 h-2 rounded-full bg-gray-800"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                </div>
            </div>
        </section>


        <!-- 新品上架 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                新品上架
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                        <!-- 商品圖片佔位 -->
                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">
                                商品圖片
                            </span>
                        </div>

                        <!-- 商品資訊 -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">
                                新品商品 {{ $i }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                商品簡短介紹
                            </p>

                            <p class="mt-3 font-bold text-gray-900">
                                ${{ 299 + ($i * 100) }}
                            </p>
                        </div>

                    </div>
                @endfor

            </div>

        </section>


        <!-- 推薦商品 -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">
                推薦商品
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @for ($i = 1; $i <= 8; $i++)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                        <!-- 商品圖片佔位 -->
                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">
                                商品圖片
                            </span>
                        </div>

                        <!-- 商品資訊 -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">
                                推薦商品 {{ $i }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                商品簡短介紹
                            </p>

                            <p class="mt-3 font-bold text-gray-900">
                                ${{ 399 + ($i * 100) }}
                            </p>
                        </div>

                    </div>
                @endfor

            </div>

        </section>

    </div>


    <!-- 返回頂部 -->
    <button
        type="button"
        class="fixed right-5 bottom-24 z-40 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600"
        aria-label="返回頂部"
    >
        ↑
    </button>


    <!-- 固定底部導覽 -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200">

        <div class="max-w-7xl mx-auto h-16 grid grid-cols-3">

            <!-- 分類 -->
            <button
                type="button"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <span class="text-xs">
                    分類
                </span>
            </button>


            <!-- 購物車 -->
            <button
                type="button"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2h12m-7 4a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"
                    />
                </svg>

                <span class="text-xs">
                    購物車
                </span>
            </button>


            <!-- 登入 -->
            @guest

                <button
                    type="button"
                    id="open-login-modal"
                    class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0zm4.5 8.5A9 9 0 0012 21a9 9 0 00-7.5-1.5"
                        />
                    </svg>

                    <span class="text-xs">
                        登入
                    </span>
                </button>
            @else
              <button
                type="button"
                id="open-member-menu"
                class="flex flex-col items-center justify-center gap-1 text-gray-600 hover:text-gray-900"
              >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19a3 3 0 11-6 0m9-12a6 6 0 11-12 0 6 6 0 0112 0z"
                        />
                    </svg>

                    <span class="text-xs truncate max-w-[80px]">
                        {{ auth()->user()->name }}
                    </span>
                </button>

            @endguest


        </div>

    </nav>


    <!-- ============================= -->
    <!-- 登入 Modal -->
    <!-- ============================= -->

    <div
        id="login-modal"
        class="hidden fixed inset-0 z-[100] overflow-y-auto"
        aria-labelledby="login-modal-title"
        role="dialog"
        aria-modal="true"
        >
        <!-- 背景遮罩 -->
        <div
            id="login-modal-backdrop"
            class="fixed inset-0 bg-black/40"
        >
    </div>
        <!-- Modal 容器 -->
        <div class="relative min-h-screen flex items-center justify-center px-4 py-8">

            <div
                id="login-modal-content"
                class="relative w-full max-w-md bg-white rounded-lg shadow-xl"
            >

                <!-- 關閉按鈕 -->
                <button
                    type="button"
                    id="close-login-modal"
                    class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full text-gray-500 hover:bg-gray-100 hover:text-gray-900"
                    aria-label="關閉登入視窗"
                >
                    ×
                </button>


                <!-- Modal 內容 -->
                <div class="p-6 sm:p-8">

                    <h2
                        id="login-modal-title"
                        class="text-2xl font-bold text-gray-900"
                    >
                        登入
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        登入後即可使用會員功能。
                    </p>


                    <!-- 登入表單 -->
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="mt-6"
                    >
                        @csrf


                        <!-- Email -->
                        <div>
                            <label
                                for="login-email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email
                            </label>

                            <input
                                id="login-email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @if ($errors->has('email'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>


                        <!-- Password -->
                        <div class="mt-4">
                            <label
                                for="login-password"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Password
                            </label>

                            <input
                                id="login-password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @if ($errors->has('password'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>


                        <!-- Remember Me -->
                        <div class="mt-4">
                            <label
                                for="login-remember"
                                class="inline-flex items-center"
                            >
                                <input
                                    id="login-remember"
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                >

                                <span class="ms-2 text-sm text-gray-600">
                                    記住我
                                </span>
                            </label>
                        </div>


                        <!-- 登入 / 註冊 -->
                        <div class="mt-6 flex items-center justify-between gap-4">

                            <a
                                href="{{ route('register') }}"
                                class="text-sm text-gray-600 underline hover:text-gray-900"
                            >
                                還沒有帳號？註冊
                            </a>

                            <button
                                type="submit"
                                class="px-5 py-2.5 rounded-md bg-gray-900 text-white text-sm font-medium hover:bg-gray-800"
                            >
                                登入
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
    @auth

    <!-- ============================= -->
    <!-- 會員浮動選單 -->
    <!-- ============================= -->

    <div
        id="member-menu"
        class="hidden fixed bottom-[72px] right-4 z-[110] w-64"
        aria-hidden="true"
    >

        <div
            id="member-menu-backdrop"
            class="fixed inset-0 -z-10"
        ></div>

        <div
            id="member-menu-panel"
            class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden opacity-0 transition-opacity duration-150"
        >

            <!-- 登入帳號 -->
            <div class="px-5 py-4 border-b border-gray-200">

                <p class="text-xs text-gray-500">
                    目前登入帳號
                </p>

                <p class="mt-1 text-base font-semibold text-gray-900 truncate">
                    {{ auth()->user()->name }}
                </p>

            </div>


            <!-- 會員中心 -->
            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-5 py-4 text-gray-800 hover:bg-gray-50 transition"
            >
                <span class="text-lg">
                    👤
                </span>

                <span class="text-sm">
                    會員中心
                </span>
            </a>


            <!-- 我的產品 -->
            <a
                href="{{ route('my-products.index') }}"
                class="flex items-center gap-3 px-5 py-4 text-gray-800 hover:bg-gray-50 transition"
            >
                <span class="text-lg">
                    📦
                </span>

                <span class="text-sm">
                    我的產品
                </span>
            </a>

            <!-- 新增產品 -->
            <a
                href="{{ route('my-products.create') }}"
                class="flex items-center gap-3 px-5 py-4 text-gray-800 hover:bg-gray-50 transition"
            >
                <span class="text-lg">
                    ➕
                </span>

                <span class="text-sm">
                    新增產品
                </span>
            </a>
            <!-- 登出 -->
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="border-t border-gray-200"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-5 py-4 text-left text-gray-800 hover:bg-gray-50 transition"
                >

                    <span class="text-lg">
                        🚪
                    </span>

                    <span class="text-sm">
                        登出
                    </span>

                </button>

            </form>

        </div>

    </div>

@endauth

<!-- 登入 Modal + 會員浮動選單 JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
         * =============================
         * 登入 Modal
         * =============================
         */

        const loginModal = document.getElementById('login-modal');
        const openLoginButton = document.getElementById('open-login-modal');
        const closeLoginButton = document.getElementById('close-login-modal');
        const loginBackdrop = document.getElementById('login-modal-backdrop');

        if (
            loginModal &&
            openLoginButton &&
            closeLoginButton &&
            loginBackdrop
        ) {
            function openLoginModal() {
                loginModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                const emailInput = document.getElementById('login-email');

                if (emailInput) {
                    setTimeout(function () {
                        emailInput.focus();
                    }, 50);
                }
            }

            function closeLoginModal() {
                loginModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            openLoginButton.addEventListener('click', function () {
                openLoginModal();
            });

            closeLoginButton.addEventListener('click', function () {
                closeLoginModal();
            });

            loginBackdrop.addEventListener('click', function () {
                closeLoginModal();
            });

            @if ($errors->any())
                openLoginModal();
            @endif
        }


        /*
         * =============================
         * 會員浮動選單
         * =============================
         */

        const memberMenu = document.getElementById('member-menu');
        const openMemberButton = document.getElementById('open-member-menu');
        const memberBackdrop = document.getElementById('member-menu-backdrop');
        const memberPanel = document.getElementById('member-menu-panel');

        if (
            memberMenu &&
            openMemberButton &&
            memberBackdrop &&
            memberPanel
        ) {

            function openMemberMenu() {
                memberMenu.classList.remove('hidden');

                requestAnimationFrame(function () {
                    memberPanel.classList.remove('opacity-0');
                    memberPanel.classList.add('opacity-100');
                });
            }

            function closeMemberMenu() {
                memberPanel.classList.remove('opacity-100');
                memberPanel.classList.add('opacity-0');

                setTimeout(function () {
                    memberMenu.classList.add('hidden');
                }, 150);
            }


            /*
             * 點擊會員按鈕
             */
            openMemberButton.addEventListener('click', function (event) {

                event.stopPropagation();

                if (memberMenu.classList.contains('hidden')) {
                    openMemberMenu();
                } else {
                    closeMemberMenu();
                }

            });


            /*
             * 點擊選單外面
             */
            memberBackdrop.addEventListener('click', function () {
                closeMemberMenu();
            });


            /*
             * 點擊選單本身不要關閉
             */
            memberPanel.addEventListener('click', function (event) {
                event.stopPropagation();
            });


            /*
             * 點擊頁面其他地方
             */
            document.addEventListener('click', function () {

                if (!memberMenu.classList.contains('hidden')) {
                    closeMemberMenu();
                }

            });


            /*
             * ESC 關閉
             */
            document.addEventListener('keydown', function (event) {

                if (
                    event.key === 'Escape' &&
                    !memberMenu.classList.contains('hidden')
                ) {
                    closeMemberMenu();
                }

            });

        }

    });
</script>

</x-app-layout>