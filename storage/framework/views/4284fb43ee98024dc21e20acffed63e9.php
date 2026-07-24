

<?php $__env->startSection('title', 'ویرایش دسته‌بندی'); ?>
<?php $__env->startSection('page-title', 'ویرایش دسته‌بندی'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow max-w-xl">

    <form method="POST"
          action="<?php echo e(route('admin.categories.update', $category->id)); ?>"
          enctype="multipart/form-data"
          class="space-y-6">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Name -->
        <div>
            <label class="block mb-2 font-semibold">نام دسته‌بندی</label>
            <input type="text"
                   name="name"
                   value="<?php echo e($category->name); ?>"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <!-- Parent -->
        <div>
            <label class="block mb-2 font-semibold">دسته والد</label>
            <select name="parent_id"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="">بدون والد</option>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($parent->id); ?>"
                        <?php echo e($category->parent_id == $parent->id ? 'selected' : ''); ?>>
                        <?php echo e($parent->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>

        <!-- Current Image -->
        <?php if($category->image): ?>
            <div>
                <label class="block mb-2 font-semibold">تصویر فعلی</label>
                <img src="<?php echo e($category->image_url); ?>"
                     class="w-32 rounded-lg">
            </div>
        <?php endif; ?>

        <!-- New Image -->
        <div>
            <label class="block mb-2 font-semibold">تغییر تصویر</label>
            <input type="file"
                   name="image"
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button class="bg-brand  px-6 py-3 rounded-lg hover:bg-brand-hover transition">
            ذخیره تغییرات
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>