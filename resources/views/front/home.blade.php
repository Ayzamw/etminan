@extends('front.layouts.app')

@section('title', 'اطمینان | فروشگاه تخصصی لوازم یدکی خودرو')

@section('content')
@if($sliders->count())

<div class="container mx-auto mt-6 mb-6">

    <div class="swiper mainSlider rounded-3xl shadow-2xl">

        <div class="swiper-wrapper">

            @foreach($sliders as $slide)

                <div class="swiper-slide">

                    <a href="{{ $slide->link ?? '#' }}">
                        <img src="{{ asset('storage/'.$slide->image) }}"
                             class="w-full h-[250px] md:h-[450px] object-cover rounded-3xl">
                    </a>

                </div>

            @endforeach

        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Swiper(".mainSlider", {
        loop: true,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        rtl: true
    });

});
</script>

@endif
@if($categories->count())

<section class="w-full mt-12 mb-16">

    <div class="px-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">
                دسته‌بندی‌های اصلی
            </h2>

            <div class="swiper-pagination category-pagination"></div>
        </div>

        <!-- ✅ Swiper -->
        <div class="swiper categorySlider w-full">

            <div class="swiper-wrapper">

                @foreach($categories as $category)

                    <div class="swiper-slide">

                        <a href="{{ route('shop.index') }}?category={{ $category->id }}"
                           class="block bg-white dark:bg-gray-800
                                  rounded-2xl shadow-md
                                  hover:shadow-xl transition
                                  p-6 text-center">

                            <img src="{{ $category->image_url }}"
                                 class="w-20 h-20 mx-auto mb-4 rounded-full object-cover">

                            <h3 class="text-sm font-semibold">
                                {{ $category->name }}
                            </h3>

                        </a>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Swiper(".categorySlider", {
        loop: true,
        speed: 600,
        spaceBetween: 20,
        grabCursor: true,
        rtl: true,

        slidesPerView: 2,

        breakpoints: {
            640: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            1024: {
                slidesPerView: 6
            },
            1280: {
                slidesPerView: 8
            }
        }
    });

});
</script>

@endif
<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-brand to-brand-hover text-white rounded-3xl p-16 mb-20 shadow-xl">

    <div class="max-w-3xl">
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
            خرید حرفه‌ای لوازم یدکی خودرو
        </h1>

        <p class="text-lg opacity-90 mb-8">
            کیفیت تضمین‌شده، ارسال سریع و بهترین قیمت بازار
        </p>

        <a href="{{ route('shop.index') }}"
           class="bg-white text-brand px-8 py-3 rounded-xl font-bold hover:scale-105 transition">
            مشاهده محصولات
        </a>
    </div>

</section>
@if($latestProducts->count())

<section class="w-full mt-16 mb-20">

    <div class="px-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                جدیدترین محصولات
            </h2>

            <a href="{{ route('shop.index') }}"
               class="text-brand font-semibold hover:underline">
                مشاهده همه →
            </a>

        </div>

        <div class="swiper productSlider">

            <div class="swiper-wrapper">

                @foreach($latestProducts as $product)

                    <div class="swiper-slide">

                        <div class="bg-white dark:bg-gray-800
                                    rounded-2xl shadow-md
                                    hover:shadow-xl transition
                                    overflow-hidden">

                            <a href="{{ route('product.show', $product->slug) }}">

                                <img src="{{ $product->image_url }}"
                                     class="w-full h-40 object-cover">

                            </a>

                            <div class="p-4">

                                <h3 class="text-sm font-semibold mb-2 line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                @if($product->isOnSale())
                                    <div class="text-xs text-gray-400 line-through">
                                        {{ number_format($product->price) }} تومان
                                    </div>

                                    <div class="text-red-600 font-bold">
                                        {{ number_format($product->sale_price) }} تومان
                                    </div>
                                @else
                                    <div class="text-green-600 font-bold">
                                        {{ number_format($product->price) }} تومان
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Swiper(".productSlider", {
        loop: true,
        speed: 700,
        spaceBetween: 20,
        grabCursor: true,
        rtl: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        slidesPerView: 2,
        breakpoints: {
            640: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 5 },
            1280: { slidesPerView: 6 }
        }
    });

});
</script>

@endif
<!-- ================= مزایا ================= -->
<section class="mb-20 grid md:grid-cols-3 gap-8 text-center">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="font-bold text-lg mb-3">ضمانت اصالت کالا</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            تمامی محصولات با تضمین کیفیت ارائه می‌شوند.
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="font-bold text-lg mb-3">ارسال سریع</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            تحویل سریع در سراسر کشور.
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="font-bold text-lg mb-3">پشتیبانی حرفه‌ای</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            تیم پشتیبانی همیشه پاسخگوی شماست.
        </p>
    </div>

</section>

@if($amazingProducts->count())

<section class="w-full mt-20 mb-24">

    <div class="px-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold text-red-600">
                💥 پیشنهادات شگفت‌انگیز
            </h2>

            <a href="{{ route('shop.index') }}"
               class="text-brand font-semibold hover:underline">
                مشاهده همه →
            </a>

        </div>

        <div class="swiper amazingSlider">

            <div class="swiper-wrapper">

                @foreach($amazingProducts as $product)

                    <div class="swiper-slide">

                        <div class="bg-white dark:bg-gray-800
                                    rounded-2xl shadow-lg
                                    hover:shadow-2xl transition
                                    overflow-hidden relative">

                            <!-- Badge -->
                            <span class="absolute top-3 right-3 bg-red-600 text-white text-xs px-3 py-1 rounded-full">
                                شگفت‌انگیز
                            </span>

                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}"
                                     class="w-full h-40 object-cover">
                            </a>

                            <div class="p-4">

                                <h3 class="text-sm font-semibold mb-2 line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                @if($product->isOnSale())

                                    <div class="text-xs text-gray-400 line-through">
                                        {{ number_format($product->price) }} تومان
                                    </div>

                                    <div class="text-red-600 font-bold">
                                        {{ number_format($product->sale_price) }} تومان
                                    </div>

                                    <div class="text-xs text-green-600 font-semibold mt-1">
                                        {{ $product->discount_percent }}٪ تخفیف
                                    </div>

                                @else

                                    <div class="text-green-600 font-bold">
                                        {{ number_format($product->price) }} تومان
                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Swiper(".amazingSlider", {
        loop: true,
        speed: 700,
        spaceBetween: 20,
        grabCursor: true,
        rtl: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false
        },
        slidesPerView: 2,
        breakpoints: {
            640: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 5 },
            1280: { slidesPerView: 6 }
        }
    });

});
</script>

@endif



@endsection