

<?php $__env->startSection('title', 'فروشگاه | اطمینان'); ?>

<?php $__env->startSection('content'); ?>

<div class="grid md:grid-cols-4 gap-8">

    <!-- ================= SIDEBAR ================= -->
    <aside class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow md:col-span-1">

        <h2 class="font-bold text-lg mb-6">
            فیلتر محصولات
        </h2>

        <form method="GET" action="<?php echo e(route('shop.index')); ?>" class="space-y-6">

            <!-- جستجو -->
            <div>
                <label class="block mb-2 text-sm font-semibold">جستجو</label>
                <input type="text"
                       name="search"
                       value="<?php echo e(request('search')); ?>"
                       class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
            </div>

            <!-- دسته -->
            <div>
                <label class="block mb-2 text-sm font-semibold">دسته‌بندی</label>
                <select name="category"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <option value="">همه</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- برند -->
            <div>
                <label class="block mb-2 text-sm font-semibold">برند</label>
                <select name="brand"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <option value="">همه</option>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>"
                            <?php echo e(request('brand') == $brand->id ? 'selected' : ''); ?>>
                            <?php echo e($brand->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- قیمت -->
            <div>
                <label class="block mb-2 text-sm font-semibold">محدوده قیمت</label>

                <input type="number"
                       name="min_price"
                       placeholder="از"
                       value="<?php echo e(request('min_price')); ?>"
                       class="w-full mb-2 px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">

                <input type="number"
                       name="max_price"
                       placeholder="تا"
                       value="<?php echo e(request('max_price')); ?>"
                       class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
            </div>

            <button class="w-full bg-brand hover:bg-brand-hover text-white py-2 rounded-lg transition">
                اعمال فیلتر
            </button>

        </form>

    </aside>

    <!-- ================= PRODUCTS ================= -->
    <section class="md:col-span-3">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-2xl transition overflow-hidden">

                    <img 
    src="<?php echo e($product->image_url); ?>"
    alt="<?php echo e($product->name); ?>"
    loading="lazy"
    width="400"
    height="400"
    class="h-52 w-full object-cover rounded-t-2xl">

                    <div class="p-5">

                        <h3 class="font-bold mb-2">
                            <?php echo e($product->name); ?>

                        </h3>

                        <p class="text-green-600 font-bold text-lg mb-3">
                            <?php echo e(number_format($product->final_price)); ?> تومان
                        </p>

                        <a href="<?php echo e(route('product.show', $product->slug)); ?>"
                           class="block text-center bg-gray-800 hover:bg-black text-white py-2 rounded-xl transition">
                            مشاهده
                        </a>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-20">
                    محصولی یافت نشد.
                </div>
            <?php endif; ?>

        </div>

        <div class="mt-10">
            <?php echo e($products->withQueryString()->links()); ?>

        </div>

    </section>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/front/products/index.blade.php ENDPATH**/ ?>