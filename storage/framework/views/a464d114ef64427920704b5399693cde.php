<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'اطمینان'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'فروشگاه تخصصی لوازم یدکی خودرو'); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#1E3A8A',
                            hover: '#1E40AF'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="overflow-x-hidden bg-gray-100 dark:bg-gray-900 dark:text-gray-200 transition duration-300 font-sans">

<!-- ================= HEADER ================= -->
<header 
    x-data="{ open: false }"
    class="bg-white dark:bg-gray-900 shadow sticky top-0 z-50 border-b dark:border-gray-800">

    <div class="container mx-auto px-4">

        <!-- Top Row -->
        <div class="flex items-center justify-between py-4">

            <!-- ✅ LOGO -->
            <a href="<?php echo e(route('home')); ?>"
               class="text-3xl font-extrabold tracking-tight">
                <span class="text-brand">اطمـ</span>
                <span class="text-blue-400">ینان</span>
            </a>

            <!-- ✅ Live Search Desktop -->
<div 
    x-data="{
        query: '',
        results: [],
        open: false,

        doSearch() {
            if (this.query.length < 2) {
                this.results = [];
                return;
            }

            fetch('<?php echo e(url('/live-search')); ?>?q=' + this.query)
                .then(res => res.json())
                .then(data => {
                    this.results = data;
                    this.open = true;
                });
        },

        highlight(text) {
            if (!this.query) return text;
            const regex = new RegExp(this.query, 'gi');
            return text.replace(regex, match => `<span class='text-brand font-bold'>${match}</span>`);
        }
    }"
    class="hidden lg:block w-1/2 relative">

    <!-- Search Input -->
    <input type="text"
           x-model="query"
           @input.debounce.300ms="doSearch"
           @focus="open = true"
           placeholder="جستجوی محصول..."
           class="w-full px-5 py-3 rounded-2xl border shadow-md focus:outline-none dark:bg-gray-800 dark:text-white">

    <!-- ✅ Mega Results -->
    <div x-show="open && results.length > 0"
         @click.away="open = false"
         x-transition
         class="absolute top-full mt-4 left-1/2 -translate-x-1/2
                w-[95vw] max-w-5xl
                bg-white dark:bg-gray-800
                shadow-2xl rounded-3xl p-8 z-50">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <template x-for="item in results" :key="item.id">

                <a :href="'<?php echo e(url('/product')); ?>/' + item.slug"
                   class="block bg-gray-50 dark:bg-gray-700 p-4 rounded-xl hover:shadow-lg transition">

                    <div class="relative">

                        <img :src="'<?php echo e(asset('storage')); ?>/' + item.image"
                             class="w-full h-32 object-cover rounded-lg mb-3">

                        <template x-if="item.sale_price">
                            <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                                تخفیف
                            </span>
                        </template>

                    </div>

                    <p class="text-sm font-semibold"
                       x-html="highlight(item.name)">
                    </p>

                    <p class="text-xs text-green-600 font-bold mt-1"
                       x-text="new Intl.NumberFormat().format(item.sale_price ?? item.price) + ' تومان'">
                    </p>

                </a>

            </template>

        </div>

        <!-- ✅ View All -->
        <div class="mt-6 text-center">
            <a :href="'<?php echo e(route('shop.index')); ?>?search=' + query"
               class="text-brand font-semibold hover:underline">
                مشاهده همه نتایج →
            </a>
        </div>

    </div>

</div>

            <!-- ✅ RIGHT CONTROLS -->
            <div class="flex items-center gap-5">

                <!-- Dark Mode -->
                <button id="theme-toggle"
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i data-feather="moon" class="w-5 h-5"></i>
                </button>

                <!-- Cart -->
                <!-- Cart -->
<div 
    x-data="{ cartOpen: false }"
    class="relative">

    <!-- Cart Icon -->
    <button @mouseenter="cartOpen = true"
            @mouseleave="cartOpen = false"
            class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">

        <i data-feather="shopping-cart" class="w-5 h-5"></i>

        <?php $cart = session('cart', []); ?>
        <?php if(count($cart) > 0): ?>
            <span class="absolute -top-1 -left-1 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                <?php echo e(count($cart)); ?>

            </span>
        <?php endif; ?>

    </button>

    <!-- Dropdown -->
    <div x-show="cartOpen"
         @mouseenter="cartOpen = true"
         @mouseleave="cartOpen = false"
         x-transition
         class="absolute left-0 mt-3 w-80 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-5 z-50">

        <h3 class="font-bold mb-4 text-sm">
            سبد خرید شما
        </h3>

        <?php if(count($cart) > 0): ?>

            <div class="space-y-4 max-h-60 overflow-y-auto">

                <?php $total = 0; ?>

                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>

                    <div class="flex justify-between items-center text-sm border-b pb-2">

                        <div>
                            <p class="font-semibold">
                                <?php echo e($item['name']); ?>

                            </p>
                            <p class="text-xs text-gray-500">
                                <?php echo e($item['quantity']); ?> × <?php echo e(number_format($item['price'])); ?>

                            </p>
                        </div>

                        <span class="font-semibold">
                            <?php echo e(number_format($subtotal)); ?>

                        </span>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <!-- Total -->
            <div class="mt-4 flex justify-between font-bold text-sm">
                <span>جمع کل:</span>
                <span><?php echo e(number_format($total)); ?> تومان</span>
            </div>

            <!-- Buttons -->
            <div class="mt-4 space-y-2">

                <a href="<?php echo e(route('cart.index')); ?>"
                   class="block text-center bg-gray-200 dark:bg-gray-700 py-2 rounded-lg text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    مشاهده سبد
                </a>

                <a href="<?php echo e(route('checkout.index')); ?>"
                   class="block text-center bg-brand text-white py-2 rounded-lg text-sm hover:bg-brand-hover transition">
                    تسویه حساب
                </a>

            </div>

        <?php else: ?>

            <p class="text-sm text-gray-500">
                سبد خرید شما خالی است.
            </p>

        <?php endif; ?>

    </div>

</div>

                <?php if(auth()->guard()->check()): ?>

                    <span class="hidden md:block text-sm font-medium">
                        <?php echo e(auth()->user()->name); ?>

                    </span>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="px-4 py-2 text-sm rounded-xl bg-gray-200 dark:bg-gray-700 hover:scale-105 transition shadow-sm">
                            خروج
                        </button>
                    </form>

                <?php else: ?>

                    <a href="<?php echo e(route('login')); ?>"
                       class="hidden md:inline-block px-5 py-2 text-sm font-semibold rounded-xl border border-brand text-brand hover:bg-brand hover:text-white transition shadow-sm">
                        ورود
                    </a>

                    <a href="<?php echo e(route('register')); ?>"
                       class="hidden md:inline-block px-6 py-2 text-sm font-semibold rounded-xl bg-gradient-to-r from-brand to-blue-500 text-white hover:scale-105 transition shadow-lg">
                        ثبت‌نام
                    </a>

                <?php endif; ?>

                <!-- Mobile Button -->
                <button @click="open = !open"
                        class="lg:hidden text-2xl">
                    ☰
                </button>

            </div>

        </div>

<!-- ✅ Navigation Desktop -->
<nav 
    x-data="{ openMenu: null }"
    class="hidden lg:flex justify-center gap-10 py-3 text-sm font-medium relative">

    <a href="<?php echo e(route('home')); ?>" class="hover:text-brand transition">
        صفحه اصلی
    </a>

    <a href="<?php echo e(route('shop.index')); ?>" class="hover:text-brand transition">
        فروشگاه
    </a>

<!-- ✅ دسته‌بندی‌ها -->
<div class="relative"
     @mouseenter="openMenu = 'categories'"
     @mouseleave="openMenu = null">

    <!-- Button -->
    <button class="hover:text-brand transition">
        دسته‌بندی‌ها
    </button>

    <!-- ✅ Mega Panel (بدون فاصله) -->
    <div x-show="openMenu === 'categories'"
         x-transition
         class="absolute left-1/2 -translate-x-1/2 top-full 
                bg-white dark:bg-gray-800 
                shadow-2xl rounded-3xl p-10 
                w-[90vw] max-w-6xl z-50">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">

            <?php $__currentLoopData = \App\Models\Category::whereNull('parent_id')->with('children')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div>

                    <a href="<?php echo e(route('shop.index', ['category' => $parent->id])); ?>"
                       class="font-bold hover:text-brand transition block mb-3">
                        <?php echo e($parent->name); ?>

                    </a>

                    <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('shop.index', ['category' => $child->id])); ?>"
                           class="block text-sm text-gray-600 dark:text-gray-400 hover:text-brand transition mb-1">
                            <?php echo e($child->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

</div>

    <!-- ✅ برندها -->
<div class="relative"
     @mouseenter="openMenu = 'brands'"
     @mouseleave="openMenu = null">

    <!-- Button -->
    <button class="hover:text-brand transition">
        برندها
    </button>

    <!-- ✅ Mega Panel -->
    <div x-show="openMenu === 'brands'"
         x-transition
         class="absolute left-1/2 -translate-x-1/2 top-full
                bg-white dark:bg-gray-800
                shadow-2xl rounded-3xl p-10
                w-[90vw] max-w-6xl z-50">

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">

            <?php $__currentLoopData = \App\Models\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <a href="<?php echo e(route('shop.index', ['brand' => $brand->id])); ?>"
                   class="flex items-center justify-center p-4
                          bg-gray-50 dark:bg-gray-700
                          rounded-xl hover:bg-brand hover:text-white
                          transition text-sm font-semibold text-center">

                    <?php echo e($brand->name); ?>


                </a>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

</div>

    <a href="#" class="hover:text-brand transition">
        درباره ما
    </a>

    <a href="#" class="hover:text-brand transition">
        تماس با ما
    </a>

</nav>

    </div>

<!-- ✅ Mobile Menu -->
<div 
    x-show="open"
    x-transition
    class="lg:hidden bg-white dark:bg-gray-900 border-t dark:border-gray-800">

    <div class="px-6 py-6 space-y-6"
         x-data="{ active: null }">

        <!-- ✅ Search -->
        <form action="<?php echo e(route('shop.index')); ?>" method="GET">
            <input type="text"
                   name="search"
                   placeholder="جستجو..."
                   class="w-full px-4 py-3 border rounded-lg dark:bg-gray-800 dark:border-gray-700">
        </form>

        <!-- ✅ Home -->
        <a href="<?php echo e(route('home')); ?>" class="block text-lg">
            صفحه اصلی
        </a>

        <!-- ✅ Shop -->
        <a href="<?php echo e(route('shop.index')); ?>" class="block text-lg">
            فروشگاه
        </a>

        <!-- ✅ Categories Accordion -->
        <div>

            <button 
                @click="active === 'cat' ? active = null : active = 'cat'"
                class="flex justify-between w-full text-lg font-semibold">
                دسته‌بندی‌ها
                <span>▾</span>
            </button>

            <div x-show="active === 'cat'"
                 x-transition
                 class="mt-4 space-y-4">

                <?php $__currentLoopData = \App\Models\Category::whereNull('parent_id')->with('children')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div x-data="{ openChild: false }">

                        <!-- ✅ Parent -->
                        <button 
                            @click="openChild = !openChild"
                            class="flex justify-between w-full text-sm font-semibold">
                            <?php echo e($parent->name); ?>

                            <span>▸</span>
                        </button>

                        <!-- ✅ Children -->
                        <div x-show="openChild"
                             x-transition
                             class="mt-2 pl-4 space-y-2">

                            <!-- Parent link -->
                            <a href="<?php echo e(route('shop.index')); ?>?category=<?php echo e($parent->id); ?>"
                               class="block text-sm text-gray-700 dark:text-gray-300 font-medium">
                                مشاهده همه <?php echo e($parent->name); ?>

                            </a>

                            <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('shop.index')); ?>?category=<?php echo e($child->id); ?>"
                                   class="block text-sm text-gray-600 dark:text-gray-400">
                                    <?php echo e($child->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        <!-- ✅ Brands Accordion -->
        <div>

            <button 
                @click="active === 'brand' ? active = null : active = 'brand'"
                class="flex justify-between w-full text-lg font-semibold">
                برندها
                <span>▾</span>
            </button>

            <div x-show="active === 'brand'"
                 x-transition
                 class="mt-4 space-y-2">

                <?php $__currentLoopData = \App\Models\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('shop.index')); ?>?brand=<?php echo e($brand->id); ?>"
                       class="block text-sm text-gray-600 dark:text-gray-400">
                        <?php echo e($brand->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        <!-- ✅ About -->
        <a href="#" class="block text-lg">
            درباره ما
        </a>

        <!-- ✅ Contact -->
        <a href="#" class="block text-lg">
            تماس با ما
        </a>

    </div>

</div>
</header>
<!-- ================= MAIN ================= -->
<main class="container mx-auto px-4 py-10 min-h-screen">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-900 text-gray-300 pt-14 pb-6" dir="rtl">
  <div class="max-w-7xl mx-auto px-6">

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

      <!-- About -->
      <div>
        <h3 class="text-xl font-bold text-yellow-400 mb-4">
          فروشگاه اینترنتی اطمینان
        </h3>
        <p class="text-sm leading-7 text-gray-400">
          اطمینان مرجع تخصصی فروش لوازم یدکی خودروهای داخلی و خارجی با ضمانت
          اصالت کالا، ارسال سریع و پشتیبانی حرفه‌ای است. هدف ما فراهم کردن
          خریدی مطمئن، آسان و مقرون‌به‌صرفه برای شماست.
        </p>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="text-lg font-semibold text-yellow-400 mb-4">
          دسترسی سریع
        </h4>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:text-yellow-400 transition">صفحه اصلی</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">فروشگاه</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">پیشنهادهای ویژه</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">مقالات</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">درباره ما</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">تماس با ما</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h4 class="text-lg font-semibold text-yellow-400 mb-4">
          ارتباط با ما
        </h4>
        <ul class="space-y-2 text-sm text-gray-400">
          <li>📍 تهران، خیابان مثال، پلاک ۱۲۳</li>
          <li>☎️ 021-12345678</li>
          <li>📱 0912-00000000</li>
          <li>📧 info@etminanparts.ir</li>
          <li>🕒 شنبه تا پنجشنبه 9 الی 18</li>
        </ul>
      </div>

      <!-- Social & Trust -->
      <div>
        <h4 class="text-lg font-semibold text-yellow-400 mb-4">
          شبکه‌های اجتماعی
        </h4>

        <div class="flex flex-col space-y-2 text-sm mb-6">
          <a href="#" class="hover:text-yellow-400 transition">اینستاگرام</a>
          <a href="#" class="hover:text-yellow-400 transition">تلگرام</a>
          <a href="#" class="hover:text-yellow-400 transition">واتساپ</a>
          <a href="#" class="hover:text-yellow-400 transition">لینکدین</a>
        </div>

        <!-- Trust Badges Placeholder -->
        <div class="flex space-x-3 space-x-reverse">
          <div class="bg-slate-800 p-3 rounded-lg text-xs text-center">
            اینماد
          </div>
          <div class="bg-slate-800 p-3 rounded-lg text-xs text-center">
            درگاه امن
          </div>
        </div>
      </div>

    </div>

    <!-- Divider -->
    <div class="border-t border-slate-700 my-8"></div>

    <!-- Bottom -->
    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 space-y-4 md:space-y-0">

      <p>
        © تمامی حقوق این وب‌سایت متعلق به فروشگاه اینترنتی اطمینان می‌باشد.
      </p>

      <div class="flex space-x-6 space-x-reverse">
        <a href="#" class="hover:text-yellow-400 transition">قوانین و مقررات</a>
        <a href="#" class="hover:text-yellow-400 transition">حریم خصوصی</a>
        <a href="#" class="hover:text-yellow-400 transition">سوالات متداول</a>
      </div>

    </div>

  </div>
</footer>
<!-- ================= TOAST NOTIFICATION ================= -->
<?php if(session('success') || session('error')): ?>

<div id="toast-container"
     class="fixed bottom-6 left-6 z-50 space-y-4">

    <?php if(session('success')): ?>
        <div class="toast bg-green-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="toast bg-red-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
            ❌ <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

</div>

<script>
    setTimeout(() => {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(t => {
            t.style.opacity = '0';
            t.style.transform = 'translateY(20px)';
        });

        setTimeout(() => {
            document.getElementById('toast-container')?.remove();
        }, 500);

    }, 3000);
</script>

<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ✅ Dark Mode */
    const html = document.documentElement;
    const toggle = document.getElementById("theme-toggle");

    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
    }

    toggle?.addEventListener("click", function () {
        html.classList.toggle("dark");
        localStorage.setItem("theme",
            html.classList.contains("dark") ? "dark" : "light"
        );
    });

    /* ✅ Feather Icons */
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\etminan\resources\views/front/layouts/app.blade.php ENDPATH**/ ?>