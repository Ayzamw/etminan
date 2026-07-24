

<?php $__env->startSection('title', 'مدیریت محصولات'); ?>
<?php $__env->startSection('page-title', 'مدیریت محصولات'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="جستجوی محصول..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <a href="<?php echo e(route('admin.products.create')); ?>"
           class="bg-brand px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            افزودن محصول
        </a>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3 text-right">تصویر</th>
                    <th class="p-3 text-right">نام</th>
                    <th class="p-3 text-right">دسته</th>
                    <th class="p-3 text-right">قیمت</th>
                    <th class="p-3 text-right">موجودی</th>
                    <th class="p-3 text-right">عملیات</th>
                </tr>
            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- Image -->
                        <td class="p-3">
                            <img src="<?php echo e($product->image_url); ?>"
                                 class="w-14 h-14 object-cover rounded-lg">
                        </td>

                        <!-- Name -->
                        <td class="p-3 font-medium">
                            <?php echo e($product->name); ?>

                        </td>

                        <!-- Category -->
                        <td class="p-3">
                            <?php echo e($product->category->name ?? '-'); ?>

                        </td>

                        <!-- Price -->
                        <td class="p-3">

                            <?php if($product->isOnSale()): ?>
                                <span class="text-gray-400 line-through block text-xs">
                                    <?php echo e(number_format($product->price)); ?>

                                </span>

                                <span class="text-red-600 font-bold">
                                    <?php echo e(number_format($product->sale_price)); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-green-600 font-bold">
                                    <?php echo e(number_format($product->price)); ?>

                                </span>
                            <?php endif; ?>

                        </td>

                        <!-- Stock -->
                        <td class="p-3">

                            <?php if($product->stock > 5): ?>
                                <span class="text-green-600 font-semibold">
                                    <?php echo e($product->stock); ?>

                                </span>
                            <?php elseif($product->stock > 0): ?>
                                <span class="text-yellow-600 font-semibold">
                                    <?php echo e($product->stock); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-red-600 font-semibold">
                                    0
                                </span>
                            <?php endif; ?>

                        </td>

                        <!-- Actions -->
                        <td class="p-3 space-x-2 space-x-reverse">

                            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>"
                               class="text-blue-600 hover:underline text-sm">
                                ویرایش
                            </a>

                            <form method="POST"
                                  action="<?php echo e(route('admin.products.destroy', $product->id)); ?>"
                                  class="inline-block"
                                  onsubmit="return confirm('حذف شود؟')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline text-sm">
                                    حذف
                                </button>
                            </form>

                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500">
                            محصولی یافت نشد.
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <?php echo e($products->withQueryString()->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/products/index.blade.php ENDPATH**/ ?>