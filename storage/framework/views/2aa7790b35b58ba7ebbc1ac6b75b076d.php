

<?php $__env->startSection('title', 'داشبورد مدیریت'); ?>

<?php $__env->startSection('page-title', 'داشبورد مدیریت'); ?>

<?php $__env->startSection('content'); ?>

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">تعداد محصولات</h3>
        <div class="text-3xl font-bold">
            <?php echo e(\App\Models\Product::count()); ?>

        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">تعداد سفارش‌ها</h3>
        <div class="text-3xl font-bold">
            <?php echo e(\App\Models\Order::count()); ?>

        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">کاربران</h3>
        <div class="text-3xl font-bold">
            <?php echo e(\App\Models\User::count()); ?>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>