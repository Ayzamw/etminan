

<?php $__env->startSection('title', 'سبد خرید | اطمینان'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-10 text-center">
    سبد خرید
</h1>

<?php if(count($cart) > 0): ?>

<div class="grid lg:grid-cols-3 gap-10">

    <!-- ================= ITEMS ================= -->
    <div class="lg:col-span-2 space-y-6">

        <?php $total = 0; ?>

        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow flex flex-col md:flex-row gap-6 items-center">

                <!-- Image -->
                <img 
    src="<?php echo e(isset($item['image']) ? $item['image'] : 'https://via.placeholder.com/150x150?text=No+Image'); ?>"
    class="w-24 h-24 object-cover rounded-lg">

                <!-- Info -->
                <div class="flex-1">

                    <h3 class="font-bold mb-2">
                        <?php echo e($item['name']); ?>

                    </h3>

                    <p class="text-green-600 font-semibold">
                        <?php echo e(number_format($item['price'])); ?> تومان
                    </p>

                </div>

                <!-- Quantity -->
                <form method="POST"
                      action="<?php echo e(route('cart.update', $id)); ?>"
                      class="flex items-center gap-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <input type="number"
                           name="quantity"
                           value="<?php echo e($item['quantity']); ?>"
                           min="1"
                           class="w-16 text-center border rounded-lg">

                    <button class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg text-sm">
                        بروزرسانی
                    </button>
                </form>

                <!-- Subtotal -->
                <div class="font-bold">
                    <?php echo e(number_format($subtotal)); ?> تومان
                </div>

                <!-- Remove -->
                <form method="POST"
                      action="<?php echo e(route('cart.remove', $id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button class="text-red-600 hover:underline text-sm">
                        حذف
                    </button>
                </form>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow h-fit">

        <h2 class="font-bold text-xl mb-6">
            خلاصه سفارش
        </h2>

        <div class="flex justify-between mb-4">
            <span>جمع کل:</span>
            <span class="font-bold text-lg">
                <?php echo e(number_format($total)); ?> تومان
            </span>
        </div>

        <a href="<?php echo e(route('checkout.index')); ?>"
           class="block text-center bg-brand hover:bg-brand-hover text-white py-3 rounded-xl transition">
            ادامه فرایند خرید
        </a>

    </div>

</div>

<?php else: ?>

<div class="bg-white dark:bg-gray-800 p-12 rounded-3xl shadow text-center">
    سبد خرید شما خالی است 🛒
</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/front/cart/index.blade.php ENDPATH**/ ?>