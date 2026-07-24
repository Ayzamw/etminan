@extends('front.layouts.app')

@section('title', 'سبد خرید | اطمینان')

@section('content')

<h1 class="text-3xl font-bold mb-10 text-center">
    سبد خرید
</h1>

@if(count($cart) > 0)

<div class="grid lg:grid-cols-3 gap-10">

    <!-- ================= ITEMS ================= -->
    <div class="lg:col-span-2 space-y-6">

        @php $total = 0; @endphp

        @foreach($cart as $id => $item)

            @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow flex flex-col md:flex-row gap-6 items-center">

                <!-- Image -->
                <img 
    src="{{ isset($item['image']) ? $item['image'] : 'https://via.placeholder.com/150x150?text=No+Image' }}"
    class="w-24 h-24 object-cover rounded-lg">

                <!-- Info -->
                <div class="flex-1">

                    <h3 class="font-bold mb-2">
                        {{ $item['name'] }}
                    </h3>

                    <p class="text-green-600 font-semibold">
                        {{ number_format($item['price']) }} تومان
                    </p>

                </div>

                <!-- Quantity -->
                <form method="POST"
                      action="{{ route('cart.update', $id) }}"
                      class="flex items-center gap-3">
                    @csrf
                    @method('PUT')

                    <input type="number"
                           name="quantity"
                           value="{{ $item['quantity'] }}"
                           min="1"
                           class="w-16 text-center border rounded-lg">

                    <button class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg text-sm">
                        بروزرسانی
                    </button>
                </form>

                <!-- Subtotal -->
                <div class="font-bold">
                    {{ number_format($subtotal) }} تومان
                </div>

                <!-- Remove -->
                <form method="POST"
                      action="{{ route('cart.remove', $id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-600 hover:underline text-sm">
                        حذف
                    </button>
                </form>

            </div>

        @endforeach

    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow h-fit">

        <h2 class="font-bold text-xl mb-6">
            خلاصه سفارش
        </h2>

        <div class="flex justify-between mb-4">
            <span>جمع کل:</span>
            <span class="font-bold text-lg">
                {{ number_format($total) }} تومان
            </span>
        </div>

        <a href="{{ route('checkout.index') }}"
           class="block text-center bg-brand hover:bg-brand-hover text-white py-3 rounded-xl transition">
            ادامه فرایند خرید
        </a>

    </div>

</div>

@else

<div class="bg-white dark:bg-gray-800 p-12 rounded-3xl shadow text-center">
    سبد خرید شما خالی است 🛒
</div>

@endif

@endsection