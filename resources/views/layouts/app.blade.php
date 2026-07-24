<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'اطمینان | فروشگاه لوازم یدکی')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<!-- ====== HEADER ====== -->
<header class="bg-white shadow sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- لوگو -->
        <a href="{{ route('shop.index') }}" class="text-2xl font-bold text-blue-600">
            اطمینان
        </a>

        <!-- منو -->
        <nav class="hidden md:flex gap-6 text-gray-700 font-medium">
            <a href="{{ route('shop.index') }}" class="hover:text-blue-600">فروشگاه</a>

            @auth
                <a href="{{ route('account.orders') }}" class="hover:text-blue-600">
                    سفارش‌های من
                </a>
            @endauth
        </nav>

        <!-- سبد خرید -->
        <div class="flex items-center gap-4">

            <a href="{{ route('cart.index') }}" class="relative">
                🛒
                @php
                    $cartCount = count(session('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-2 -left-3 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </span>
            @else
                <a href="{{ route('login') }}" class="text-sm text-blue-600">
                    ورود
                </a>
            @endauth

        </div>

    </div>
</header>


<!-- ====== CONTENT ====== -->
<main class="py-10">
    <div class="container mx-auto px-6">
        @yield('content')
    </div>
</main>


<!-- ====== FOOTER ====== -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="container mx-auto px-6 py-8 text-center text-sm">
        © {{ date('Y') }} فروشگاه لوازم یدکی اطمینان - تمامی حقوق محفوظ است.
    </div>
</footer>

</body>
</html>