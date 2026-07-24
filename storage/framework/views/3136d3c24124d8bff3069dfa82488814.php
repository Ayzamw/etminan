

<?php $__env->startSection('title', 'مدیریت اسلایدر'); ?>
<?php $__env->startSection('page-title', 'مدیریت اسلایدر'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="font-bold text-lg">لیست اسلایدر</h2>

        <a href="<?php echo e(route('admin.sliders.create')); ?>"
           class="bg-brand  px-6 py-2 rounded-lg">
            افزودن اسلاید
        </a>
    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">تصویر</th>
                <th class="p-3 text-right">عنوان</th>
                <th class="p-3 text-right">ترتیب</th>
                <th class="p-3 text-right">وضعیت</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">

                    <td class="p-3">
                        <img src="<?php echo e(asset('storage/'.$slider->image)); ?>"
                             class="w-32 rounded-lg">
                    </td>

                    <td class="p-3">
                        <?php echo e($slider->title); ?>

                    </td>

                    <td class="p-3">
                        <?php echo e($slider->sort_order); ?>

                    </td>

                    <td class="p-3">
                        <?php if($slider->status): ?>
                            <span class="text-green-600">فعال</span>
                        <?php else: ?>
                            <span class="text-red-600">غیرفعال</span>
                        <?php endif; ?>
                    </td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="<?php echo e(route('admin.sliders.edit', $slider->id)); ?>"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="<?php echo e(route('admin.sliders.destroy', $slider->id)); ?>"
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>