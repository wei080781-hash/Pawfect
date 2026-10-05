<nav class="bg-white border-b border-gray-100">
    <div class="h-16 flex items-center justify-center relative">

        <!-- Hamburger -->
        <button
            type="button"
            class="absolute left-4 inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none"
            aria-label="商品分類"
        >
            <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
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
            class="text-xl font-bold text-gray-800"
        >
            Pawfect
        </a>

    </div>
</nav>
