

<?php $__env->startSection('title', 'جزئیات سفارش'); ?>
<?php $__env->startSection('page-title', 'جزئیات سفارش #' . $order->id); ?>

<?php $__env->startSection('content'); ?>

<div class="grid md:grid-cols-2 gap-8">

    <!-- Customer Info -->
    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <h3 class="font-bold text-lg">اطلاعات مشتری</h3>

        <p><strong>نام:</strong> <?php echo e($order->customer_name); ?></p>
        <p><strong>شماره تماس:</strong> <?php echo e($order->customer_phone); ?></p>
        <p><strong>آدرس:</strong> <?php echo e($order->customer_address); ?></p>

        <p><strong>مبلغ کل:</strong>
            <?php echo e(number_format($order->total_amount)); ?> تومان
        </p>

    </div>

    <!-- Update Status -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold text-lg mb-4">تغییر وضعیت سفارش</h3>

        <form method="POST"
              action="<?php echo e(route('admin.orders.update', $order->id)); ?>"
              class="space-y-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <select name="status"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>در انتظار</option>
                <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>در حال پردازش</option>
                <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>تکمیل شده</option>
                <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>لغو شده</option>
            </select>

            <button class="bg-brand px-6 py-2 rounded-lg">
                ذخیره
            </button>

        </form>

    </div>

</div>

<!-- Order Items -->
<div class="bg-white p-6 rounded-2xl shadow mt-10">

    <h3 class="font-bold text-lg mb-6">محصولات سفارش</h3>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام محصول</th>
                <th class="p-3 text-right">تعداد</th>
                <th class="p-3 text-right">قیمت</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($item->product_name); ?></td>
                    <td class="p-3"><?php echo e($item->quantity); ?></td>
                    <td class="p-3">
                        <?php echo e(number_format($item->price)); ?> تومان
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>