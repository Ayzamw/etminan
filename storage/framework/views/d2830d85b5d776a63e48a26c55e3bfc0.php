

<?php $__env->startSection('title', 'افزودن اسلاید'); ?>
<?php $__env->startSection('page-title', 'افزودن اسلاید جدید'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">

<form method="POST"
      action="<?php echo e(route('admin.sliders.store')); ?>"
      enctype="multipart/form-data"
      class="space-y-6">

    <?php echo csrf_field(); ?>

    <div>
        <label class="block mb-2">عنوان</label>
        <input type="text" name="title"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">لینک</label>
        <input type="text" name="link"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">ترتیب</label>
        <input type="number" name="sort_order"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">تصویر</label>
        <input type="file" name="image"
               class="w-full px-4 py-2 border rounded-lg"
               required>
    </div>

    <div class="flex items-center gap-3">
        <input type="checkbox" name="status" checked>
        <label>فعال</label>
    </div>

    <button class="bg-brand text-white px-6 py-3 rounded-lg">
        ذخیره
    </button>

</form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/sliders/create.blade.php ENDPATH**/ ?>