

<?php $__env->startSection('title', $product->name . ' | اطمینان'); ?>

<?php $__env->startSection('content'); ?>

<!-- Breadcrumb -->
<?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
    ['title' => 'صفحه اصلی', 'url' => route('home')],
    ['title' => 'فروشگاه', 'url' => route('shop.index')],
    ['title' => $product->name, 'url' => '#']
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    ['title' => 'صفحه اصلی', 'url' => route('home')],
    ['title' => 'فروشگاه', 'url' => route('shop.index')],
    ['title' => $product->name, 'url' => '#']
])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $attributes = $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $component = $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>

<div class="grid md:grid-cols-2 gap-12">

    <!-- IMAGE -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow">

        <div class="relative">
            <img 
    src="<?php echo e($product->image_url); ?>"
    alt="<?php echo e($product->name); ?>"
    loading="eager"
    width="600"
    height="600"
    class="w-full h-[400px] object-cover rounded-2xl">

            <?php if($product->isOnSale()): ?>
                <span class="absolute top-4 right-4 bg-red-600 text-white text-sm px-4 py-2 rounded-full">
                    <?php echo e($product->discount_percent); ?>٪ تخفیف
                </span>
            <?php endif; ?>
        </div>

    </div>


    <!-- INFO -->
    <div class="space-y-8">

        <h1 class="text-3xl font-extrabold">
            <?php echo e($product->name); ?>

        </h1>
        <!-- Rating Summary -->
<div class="flex items-center gap-3 mt-2">

    <div class="flex text-yellow-400 text-lg">
        <?php for($i = 1; $i <= 5; $i++): ?>
            <?php if($product->average_rating >= $i): ?>
                ★
            <?php elseif($product->average_rating >= $i - 0.5): ?>
                ☆
            <?php else: ?>
                ☆
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <span class="text-sm text-gray-600 dark:text-gray-400">
        <?php echo e($product->average_rating); ?> از 5
        (<?php echo e($product->review_count); ?> نظر)
    </span>

</div>
        <!-- Price -->
        <?php if($product->isOnSale()): ?>

            <div>
                <span class="text-gray-400 line-through text-lg block">
                    <?php echo e(number_format($product->price)); ?> تومان
                </span>

                <span class="text-red-600 text-3xl font-bold">
                    <?php echo e(number_format($product->sale_price)); ?> تومان
                </span>
            </div>

        <?php else: ?>

            <span class="text-green-600 text-3xl font-bold">
                <?php echo e(number_format($product->price)); ?> تومان
            </span>

        <?php endif; ?>


        <!-- Stock -->
        <?php if($product->stock > 0): ?>

            <span class="text-green-600 font-semibold">
                ✅ موجود در انبار (<?php echo e($product->stock); ?> عدد)
            </span>

        <?php else: ?>

            <span class="text-red-600 font-semibold">
                ❌ موجودی این محصول به پایان رسیده است
            </span>

        <?php endif; ?>


        <!-- Description -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4">توضیحات محصول</h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                <?php echo e($product->description ?? 'توضیحی ثبت نشده است.'); ?>

            </p>
        </div>
        <!-- ================= REVIEW SECTION ================= -->

<div class="mt-16 bg-white dark:bg-gray-800 p-8 rounded-3xl shadow">

    <h3 class="text-xl font-bold mb-6">نظرات کاربران</h3>

    <?php if(auth()->guard()->check()): ?>
        <form action="<?php echo e(route('product.review', $product->id)); ?>"
              method="POST"
              class="space-y-4 mb-10">
            <?php echo csrf_field(); ?>

            <!-- Rating -->
            <div>
                <label class="block mb-2 font-semibold">امتیاز شما</label>
                <select name="rating"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600"
                        required>
                    <option value="">انتخاب کنید</option>
                    <option value="5">⭐⭐⭐⭐⭐ عالی</option>
                    <option value="4">⭐⭐⭐⭐ خوب</option>
                    <option value="3">⭐⭐⭐ متوسط</option>
                    <option value="2">⭐⭐ ضعیف</option>
                    <option value="1">⭐ خیلی ضعیف</option>
                </select>
            </div>

            <!-- Comment -->
            <div>
                <label class="block mb-2 font-semibold">نظر شما</label>
                <textarea name="comment"
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600"
                          placeholder="نظر خود را بنویسید..."></textarea>
            </div>

            <button class="bg-brand hover:bg-brand-hover text-white px-6 py-3 rounded-xl transition">
                ثبت نظر
            </button>

        </form>
    <?php else: ?>
        <div class="mb-8 text-sm text-gray-600 dark:text-gray-400">
            برای ثبت نظر لطفاً وارد حساب کاربری خود شوید.
        </div>
    <?php endif; ?>


    <!-- Existing Reviews -->
    <div class="space-y-6">

        <?php $__empty_1 = true; $__currentLoopData = $product->reviews()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="border-b pb-4">

                <div class="flex items-center justify-between mb-2">

                    <div class="font-semibold">
                        <?php echo e($review->user->name); ?>

                    </div>

                    <div class="text-yellow-400">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php echo e($i <= $review->rating ? '★' : '☆'); ?>

                        <?php endfor; ?>
                    </div>

                </div>

                <?php if($review->comment): ?>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <?php echo e($review->comment); ?>

                    </p>
                <?php endif; ?>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-sm text-gray-500">
                هنوز نظری ثبت نشده است.
            </div>
        <?php endif; ?>

    </div>

</div>
        <!-- CTA -->
        <?php if($product->stock > 0): ?>

            <a href="<?php echo e(route('cart.add', $product->id)); ?>"
               class="block text-center bg-brand hover:bg-brand-hover text-white py-4 rounded-2xl text-lg font-bold transition shadow-lg hover:shadow-xl">
                افزودن به سبد خرید
            </a>

        <?php else: ?>

            <button disabled
                    class="w-full bg-gray-400 text-white py-4 rounded-2xl text-lg font-bold cursor-not-allowed">
                ناموجود
            </button>

        <?php endif; ?>

    </div>

</div>


<!-- ================= PRODUCT SCHEMA ================= -->

<?php
$productSchema = [
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $product->name,
    "image" => $product->image_url,
    "description" => strip_tags($product->description ?? ''),
    "sku" => (string) $product->id,
    "url" => url()->current(),
    "brand" => [
        "@type" => "Brand",
        "name" => $product->brand->name ?? "اطمینان"
    ],
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => $product->average_rating,
        "reviewCount" => $product->review_count
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "IRR",
        "price" => (string) $product->final_price,
        "availability" => $product->stock > 0
            ? "https://schema.org/InStock"
            : "https://schema.org/OutOfStock"
    ]
];
?>

<script type="application/ld+json">
<?php echo json_encode($productSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\etminan\resources\views/front/products/show.blade.php ENDPATH**/ ?>