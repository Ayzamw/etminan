<?php $__env->startSection('title', 'ورود | اطمینان'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl">

    <h2 class="text-2xl font-bold mb-6 text-center">
        ورود به حساب کاربری
    </h2>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>

        <div>
            <label class="block mb-2 text-sm font-semibold">ایمیل</label>
            <input type="email"
                   name="email"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold">رمز عبور</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <button class="w-full bg-brand hover:bg-brand-hover text-white py-3 rounded-xl font-semibold transition shadow-lg">
            ورود
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/auth/login.blade.php ENDPATH**/ ?>