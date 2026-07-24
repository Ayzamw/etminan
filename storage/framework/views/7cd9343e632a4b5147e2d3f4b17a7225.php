

<?php $__env->startSection('title', 'مدیریت سفارش‌ها'); ?>
<?php $__env->startSection('page-title', 'مدیریت سفارش‌ها'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="جستجو مشتری..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">#</th>
                <th class="p-3 text-right">مشتری</th>
                <th class="p-3 text-right">مبلغ</th>
                <th class="p-3 text-right">وضعیت</th>
                <th class="p-3 text-right">تاریخ</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3 font-semibold">
                        #<?php echo e($order->id); ?>

                    </td>

                    <td class="p-3">
                        <?php echo e($order->customer_name); ?>

                    </td>

                    <td class="p-3 font-bold">
                        <?php echo e(number_format($order->total_amount)); ?> تومان
                    </td>

                    <td class="p-3">

                        <?php switch($order->status):
                            case ('pending'): ?>
                                <span class="text-yellow-600 font-semibold">در انتظار</span>
                                <?php break; ?>
                            <?php case ('processing'): ?>
                                <span class="text-blue-600 font-semibold">در حال پردازش</span>
                                <?php break; ?>
                            <?php case ('completed'): ?>
                                <span class="text-green-600 font-semibold">تکمیل شده</span>
                                <?php break; ?>
                            <?php case ('cancelled'): ?>
                                <span class="text-red-600 font-semibold">لغو شده</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="text-gray-600"><?php echo e($order->status); ?></span>
                        <?php endswitch; ?>

                    </td>

                    <td class="p-3">
                        <?php echo e($order->created_at->format('Y-m-d')); ?>

                    </td>

                    <td class="p-3">

    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
       class="text-blue-600 text-sm">
        مشاهده
    </a>

    <form method="POST"
          action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>"
          class="inline"
          onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این سفارش حذف شود؟')">
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
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        سفارشی ثبت نشده است.
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>

    </table>

    <div class="mt-6">
        <?php echo e($orders->withQueryString()->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>