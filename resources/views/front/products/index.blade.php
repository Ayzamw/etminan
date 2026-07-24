@extends('front.layouts.app')

@section('title', 'فروشگاه | اطمینان')

@section('content')

<div class="grid md:grid-cols-4 gap-8">

    <!-- ================= SIDEBAR ================= -->
    <aside class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow md:col-span-1">

        <h2 class="font-bold text-lg mb-6">
            فیلتر محصولات
        </h2>

        <form method="GET" action="{{ route('shop.index') }}" class="space-y-6">

            <!-- جستجو -->
            <div>
                <label class="block mb-2 text-sm font-semibold">جستجو</label>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
            </div>

            <!-- دسته -->
            <div>
                <label class="block mb-2 text-sm font-semibold">دسته‌بندی</label>
                <select name="category"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <option value="">همه</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- برند -->
            <div>
                <label class="block mb-2 text-sm font-semibold">برند</label>
                <select name="brand"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <option value="">همه</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- قیمت -->
            <div>
                <label class="block mb-2 text-sm font-semibold">محدوده قیمت</label>

                <input type="number"
                       name="min_price"
                       placeholder="از"
                       value="{{ request('min_price') }}"
                       class="w-full mb-2 px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">

                <input type="number"
                       name="max_price"
                       placeholder="تا"
                       value="{{ request('max_price') }}"
                       class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
            </div>

            <button class="w-full bg-brand hover:bg-brand-hover text-white py-2 rounded-lg transition">
                اعمال فیلتر
            </button>

        </form>

    </aside>

    <!-- ================= PRODUCTS ================= -->
    <section class="md:col-span-3">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($products as $product)

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-2xl transition overflow-hidden">

                    <img 
    src="{{ $product->image_url }}"
    alt="{{ $product->name }}"
    loading="lazy"
    width="400"
    height="400"
    class="h-52 w-full object-cover rounded-t-2xl">

                    <div class="p-5">

                        <h3 class="font-bold mb-2">
                            {{ $product->name }}
                        </h3>

                        <p class="text-green-600 font-bold text-lg mb-3">
                            {{ number_format($product->final_price) }} تومان
                        </p>

                        <a href="{{ route('product.show', $product->slug) }}"
                           class="block text-center bg-gray-800 hover:bg-black text-white py-2 rounded-xl transition">
                            مشاهده
                        </a>

                    </div>

                </div>

            @empty
                <div class="col-span-3 text-center py-20">
                    محصولی یافت نشد.
                </div>
            @endforelse

        </div>

        <div class="mt-10">
            {{ $products->withQueryString()->links() }}
        </div>

    </section>

</div>

@endsection