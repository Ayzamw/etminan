

<?php $__env->startSection('title', 'مدیریت برند'); ?>
<?php $__env->startSection('page-title', 'مدیریت برند'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="جستجو برند..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <a href="<?php echo e(route('admin.brands.create')); ?>"
           class="bg-brand  px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            افزودن برند
        </a>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام برند</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3 font-medium">
                        <?php echo e($brand->name); ?>

                    </td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="<?php echo e(route('admin.brands.edit', $brand->id)); ?>"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="<?php echo e(route('admin.brands.destroy', $brand->id)); ?>"
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
                        هنوز برندی ثبت نشده است.
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>

    </table>

    <div class="mt-6">
        <?php echo e($brands->withQueryString()->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/brands/index.blade.php ENDPATH**/ ?>