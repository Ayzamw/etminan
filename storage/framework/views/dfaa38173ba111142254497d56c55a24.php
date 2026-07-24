

<?php $__env->startSection('title', 'تسویه حساب | اطمینان'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-10 text-center">
    تسویه حساب
</h1>

<div class="grid lg:grid-cols-3 gap-10">

    <!-- ================= FORM ================= -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-8 rounded-3xl shadow">

        <form method="POST"
              action="<?php echo e(route('checkout.store')); ?>"
              class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block mb-2 font-semibold">نام و نام خانوادگی</label>
                <input type="text"
                       name="customer_name"
                       class="w-full px-4 py-3 border rounded-xl dark:bg-gray-700 dark:border-gray-600"
                       required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">شماره تماس</label>
                <input type="text"
                       name="customer_phone"
                       class="w-full px-4 py-3 border rounded-xl dark:bg-gray-700 dark:border-gray-600"
                       required>
            </div>

            <div>
                <label class="block mb-2 font-semibold">آدرس کامل</label>
                <textarea name="customer_address"
                          rows="4"
                          class="w-full px-4 py-3 border rounded-xl dark:bg-gray-700 dark:border-gray-600"
                          required></textarea>
            </div>

            <button class="w-full bg-brand hover:bg-brand-hover text-white py-4 rounded-2xl text-lg font-bold transition shadow-lg">
                ثبت سفارش
            </button>

        </form>

    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow h-fit">

        <h2 class="font-bold text-xl mb-6">
            خلاصه سفارش
        </h2>

        <?php $total = 0; ?>

        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>

            <div class="flex justify-between mb-4 text-sm">
                <span><?php echo e($item['name']); ?> × <?php echo e($item['quantity']); ?></span>
                <span><?php echo e(number_format($subtotal)); ?></span>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <hr class="my-4">

        <div class="flex justify-between font-bold text-lg">
            <span>جمع کل:</span>
            <span><?php echo e(number_format($total)); ?> تومان</span>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/front/checkout/index.blade.php ENDPATH**/ ?>