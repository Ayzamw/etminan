<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['items']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav class="text-sm mb-6 text-gray-500 dark:text-gray-400">
    <ol class="flex items-center space-x-2 space-x-reverse">

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if(!$loop->last): ?>
                <li>
                    <a href="<?php echo e($item['url']); ?>"
                       class="hover:text-brand transition">
                        <?php echo e($item['title']); ?>

                    </a>
                </li>
                <li>/</li>
            <?php else: ?>
                <li class="text-gray-700 dark:text-gray-200 font-medium">
                    <?php echo e($item['title']); ?>

                </li>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ol>
</nav><?php /**PATH C:\xampp\htdocs\etminan\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>