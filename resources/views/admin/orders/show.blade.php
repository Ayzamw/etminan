@extends('admin.layouts.app')

@section('title', 'جزئیات سفارش')
@section('page-title', 'جزئیات سفارش #' . $order->id)

@section('content')

<div class="grid md:grid-cols-2 gap-8">

    <!-- Customer Info -->
    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <h3 class="font-bold text-lg">اطلاعات مشتری</h3>

        <p><strong>نام:</strong> {{ $order->customer_name }}</p>
        <p><strong>شماره تماس:</strong> {{ $order->customer_phone }}</p>
        <p><strong>آدرس:</strong> {{ $order->customer_address }}</p>

        <p><strong>مبلغ کل:</strong>
            {{ number_format($order->total_amount) }} تومان
        </p>

    </div>

    <!-- Update Status -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold text-lg mb-4">تغییر وضعیت سفارش</h3>

        <form method="POST"
              action="{{ route('admin.orders.update', $order->id) }}"
              class="space-y-4">
            @csrf
            @method('PUT')

            <select name="status"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>در انتظار</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>در حال پردازش</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>لغو شده</option>
            </select>

            <button class="bg-brand px-6 py-2 rounded-lg">
                ذخیره
            </button>

        </form>

    </div>

</div>

<!-- Order Items -->
<div class="bg-white p-6 rounded-2xl shadow mt-10">

    <h3 class="font-bold text-lg mb-6">محصولات سفارش</h3>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام محصول</th>
                <th class="p-3 text-right">تعداد</th>
                <th class="p-3 text-right">قیمت</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->product_name }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">
                        {{ number_format($item->price) }} تومان
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection