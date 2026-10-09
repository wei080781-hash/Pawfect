<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pawfect') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">

        <!-- ============================= -->
        <!-- 頂部導覽列 -->
        <!-- ============================= -->

        <header class="h-16 bg-white border-b border-gray-200 flex items-center">

            <div class="flex items-center w-full px-4">

                <!-- Sidebar 開關 -->
                <button
                    type="button"
                    id="member-sidebar-toggle"
                    class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition"
                    aria-label="開啟或關閉會員中心選單"
                    aria-expanded="true"
                >
                    <svg
                        class="w-6 h-6"
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
                </button>

                <!-- Logo -->
                <a
                    href="{{ route('home') }}"
                    class="ml-3 text-xl font-bold text-gray-900"
                >
                    Pawfect
                </a>

            </div>

        </header>


        <!-- ============================= -->
        <!-- 會員中心主要區域 -->
        <!-- ============================= -->

        <div class="flex min-h-[calc(100vh-4rem)]">

            <!-- ============================= -->
            <!-- Sidebar -->
            <!-- ============================= -->

            <aside
                id="member-sidebar"
                class="w-64 shrink-0 bg-white border-r border-gray-200 transition-all duration-300 overflow-hidden"
            >

                <nav class="p-4 space-y-2">

                    <!-- 會員中心 -->

                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition
                        {{ request()->routeIs('profile.*') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}"
                    >

                        <span class="text-lg">
                            👤
                        </span>

                        <span class="member-sidebar-text whitespace-nowrap">
                            會員中心
                        </span>

                    </a>


                    <!-- 我的產品 -->

                    <a
                        href="{{ route('my-products.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition
                        {{ request()->routeIs('my-products.index') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}"
                    >

                        <span class="text-lg">
                            📦
                        </span>

                        <span class="member-sidebar-text whitespace-nowrap">
                            我的產品
                        </span>

                    </a>


                    <!-- 新增產品 -->

                    <a
                        href="{{ route('my-products.create') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition
                        {{ request()->routeIs('my-products.create') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}"
                    >

                        <span class="text-lg">
                            ➕
                        </span>

                        <span class="member-sidebar-text whitespace-nowrap">
                            新增產品
                        </span>

                    </a>


                    <!-- 回收桶 -->

                    <a
                        href="{{ route('my-products.trashed') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition
                        {{ request()->routeIs('my-products.trashed') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}"
                    >

                        <span class="text-lg">
                            🗑️
                        </span>

                        <span class="member-sidebar-text whitespace-nowrap">
                            回收桶
                        </span>

                    </a>


                    <!-- 登出 -->

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="pt-2 mt-2 border-t border-gray-200"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition text-left"
                        >

                            <span class="text-lg">
                                🚪
                            </span>

                            <span class="member-sidebar-text whitespace-nowrap">
                                登出
                            </span>

                        </button>

                    </form>

                </nav>

            </aside>


            <!-- ============================= -->
            <!-- 右側內容 -->
            <!-- ============================= -->

            <main
                id="member-content"
                class="flex-1 min-w-0 p-6 transition-all duration-300"
            >

                @yield('content')

            </main>

        </div>

    </div>


    <!-- ============================= -->
    <!-- Sidebar 開關 JavaScript -->
    <!-- ============================= -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const toggleButton = document.getElementById('member-sidebar-toggle');
            const sidebar = document.getElementById('member-sidebar');
            const sidebarTexts = document.querySelectorAll('.member-sidebar-text');

            if (!toggleButton || !sidebar) {
                return;
            }

            const storageKey = 'pawfect-member-sidebar-open';

            /*
             * 讀取之前保存的 Sidebar 狀態
             *
             * true  = 展開
             * false = 收合
             */
            const savedState = localStorage.getItem(storageKey);

            /*
             * 第一次使用時預設展開
             */
            const isOpen = savedState === null
                ? true
                : savedState === 'true';


            /*
             * 套用 Sidebar 狀態
             */
            function setSidebarState(open) {

                if (open) {

                    // 展開 Sidebar
                    sidebar.classList.remove('w-0');
                    sidebar.classList.add('w-64');

                    sidebarTexts.forEach(function (text) {
                        text.classList.remove('hidden');
                    });

                    toggleButton.setAttribute('aria-expanded', 'true');

                    localStorage.setItem(storageKey, 'true');

                } else {

                    // 收合 Sidebar
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-0');

                    sidebarTexts.forEach(function (text) {
                        text.classList.add('hidden');
                    });

                    toggleButton.setAttribute('aria-expanded', 'false');

                    localStorage.setItem(storageKey, 'false');

                }

            }


            /*
             * 頁面載入時套用之前的狀態
             */
            setSidebarState(isOpen);


            /*
             * 點擊 ☰
             */
            toggleButton.addEventListener('click', function () {

                const currentlyOpen =
                    sidebar.classList.contains('w-64');

                setSidebarState(!currentlyOpen);

            });

        });

    </script>
</body>
</html>