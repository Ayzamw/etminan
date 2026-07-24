

<?php $__env->startSection('title', 'مدیریت دسته‌بندی'); ?>
<?php $__env->startSection('page-title', 'مدیریت دسته‌بندی'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="جستجو..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <!-- ✅ این همون دکمه‌ایه که لازم داری -->
        <a href="<?php echo e(route('admin.categories.create')); ?>"
           class="bg-brand  px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            + افزودن دسته
        </a>

    </div>

    <!-- Table -->
    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($category->name); ?></td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                              class="inline"
                              onsubmit="return confirm('حذف شود؟')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 text-sm">
                                حذف
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="2" class="text-center p-6 text-gray-500">
                        هنوز دسته‌ای ثبت نشده است.
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>

    </table>

    <div class="mt-6">
        <?php echo e($categories->withQueryString()->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>