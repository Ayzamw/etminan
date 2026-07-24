@extends('front.layouts.app')

@section('title', $product->name . ' | اطمینان')

@section('content')

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['title' => 'صفحه اصلی', 'url' => route('home')],
    ['title' => 'فروشگاه', 'url' => route('shop.index')],
    ['title' => $product->name, 'url' => '#']
]" />

<div class="grid md:grid-cols-2 gap-12">

    <!-- IMAGE -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow">

        <div class="relative">
            <img 
    src="{{ $product->image_url }}"
    alt="{{ $product->name }}"
    loading="eager"
    width="600"
    height="600"
    class="w-full h-[400px] object-cover rounded-2xl">

            @if($product->isOnSale())
                <span class="absolute top-4 right-4 bg-red-600 text-white text-sm px-4 py-2 rounded-full">
                    {{ $product->discount_percent }}٪ تخفیف
                </span>
            @endif
        </div>

    </div>


    <!-- INFO -->
    <div class="space-y-8">

        <h1 class="text-3xl font-extrabold">
            {{ $product->name }}
        </h1>
        <!-- Rating Summary -->
<div class="flex items-center gap-3 mt-2">

    <div class="flex text-yellow-400 text-lg">
        @for ($i = 1; $i <= 5; $i++)
            @if($product->average_rating >= $i)
                ★
            @elseif($product->average_rating >= $i - 0.5)
                ☆
            @else
                ☆
            @endif
        @endfor
    </div>

    <span class="text-sm text-gray-600 dark:text-gray-400">
        {{ $product->average_rating }} از 5
        ({{ $product->review_count }} نظر)
    </span>

</div>
        <!-- Price -->
        @if($product->isOnSale())

            <div>
                <span class="text-gray-400 line-through text-lg block">
                    {{ number_format($product->price) }} تومان
                </span>

                <span class="text-red-600 text-3xl font-bold">
                    {{ number_format($product->sale_price) }} تومان
                </span>
            </div>

        @else

            <span class="text-green-600 text-3xl font-bold">
                {{ number_format($product->price) }} تومان
            </span>

        @endif


        <!-- Stock -->
        @if($product->stock > 0)

            <span class="text-green-600 font-semibold">
                ✅ موجود در انبار ({{ $product->stock }} عدد)
            </span>

        @else

            <span class="text-red-600 font-semibold">
                ❌ موجودی این محصول به پایان رسیده است
            </span>

        @endif


        <!-- Description -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4">توضیحات محصول</h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ $product->description ?? 'توضیحی ثبت نشده است.' }}
            </p>
        </div>
        <!-- ================= REVIEW SECTION ================= -->

<div class="mt-16 bg-white dark:bg-gray-800 p-8 rounded-3xl shadow">

    <h3 class="text-xl font-bold mb-6">نظرات کاربران</h3>

    @auth
        <form action="{{ route('product.review', $product->id) }}"
              method="POST"
              class="space-y-4 mb-10">
            @csrf

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
    @else
        <div class="mb-8 text-sm text-gray-600 dark:text-gray-400">
            برای ثبت نظر لطفاً وارد حساب کاربری خود شوید.
        </div>
    @endauth


    <!-- Existing Reviews -->
    <div class="space-y-6">

        @forelse($product->reviews()->latest()->get() as $review)

            <div class="border-b pb-4">

                <div class="flex items-center justify-between mb-2">

                    <div class="font-semibold">
                        {{ $review->user->name }}
                    </div>

                    <div class="text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->rating ? '★' : '☆' }}
                        @endfor
                    </div>

                </div>

                @if($review->comment)
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $review->comment }}
                    </p>
                @endif

            </div>

        @empty
            <div class="text-sm text-gray-500">
                هنوز نظری ثبت نشده است.
            </div>
        @endforelse

    </div>

</div>
        <!-- CTA -->
        @if($product->stock > 0)

            <a href="{{ route('cart.add', $product->id) }}"
               class="block text-center bg-brand hover:bg-brand-hover text-white py-4 rounded-2xl text-lg font-bold transition shadow-lg hover:shadow-xl">
                افزودن به سبد خرید
            </a>

        @else

            <button disabled
                    class="w-full bg-gray-400 text-white py-4 rounded-2xl text-lg font-bold cursor-not-allowed">
                ناموجود
            </button>

        @endif

    </div>

</div>


<!-- ================= PRODUCT SCHEMA ================= -->

@php
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
@endphp

<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>

@endsection