<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'پنل مدیریت | اطمینان'); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        admin: {
                            DEFAULT: '#0F172A',
                            sidebar: '#1E293B'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 bg-admin-sidebar text-white hidden md:flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            ادمین اطمینان
        </div>

        <nav class="flex-1 p-4 space-y-2 text-sm">

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                داشبورد
            </a>

            <a href="<?php echo e(route('admin.products.index')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                محصولات
            </a>

            <a href="<?php echo e(route('admin.categories.index')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                دسته‌بندی‌ها
            </a>

            <a href="<?php echo e(route('admin.brands.index')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                برندها
            </a>
            <a href="<?php echo e(route('admin.sliders.index')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                اسلایدر
            </a>
            <a href="<?php echo e(route('admin.orders.index')); ?>"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                سفارش‌ها
            </a>

        </nav>

        <div class="p-4 border-t border-gray-700 text-sm">
            <?php echo e(auth()->user()->name); ?>

        </div>

    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <h1 class="font-bold text-lg">
                <?php echo $__env->yieldContent('page-title'); ?>
            </h1>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="text-red-600 hover:underline text-sm">
                    خروج
                </button>
            </form>

        </header>

        <!-- Content -->
        <main class="p-8 flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

</div>

</body>
</html><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>