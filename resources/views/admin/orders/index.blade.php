@extends('admin.layouts.app')

@section('title', 'مدیریت سفارش‌ها')
@section('page-title', 'مدیریت سفارش‌ها')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="جستجو مشتری..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">#</th>
                <th class="p-3 text-right">مشتری</th>
                <th class="p-3 text-right">مبلغ</th>
                <th class="p-3 text-right">وضعیت</th>
                <th class="p-3 text-right">تاریخ</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3 font-semibold">
                        #{{ $order->id }}
                    </td>

                    <td class="p-3">
                        {{ $order->customer_name }}
                    </td>

                    <td class="p-3 font-bold">
                        {{ number_format($order->total_amount) }} تومان
                    </td>

                    <td class="p-3">

                        @switch($order->status)
                            @case('pending')
                                <span class="text-yellow-600 font-semibold">در انتظار</span>
                                @break
                            @case('processing')
                                <span class="text-blue-600 font-semibold">در حال پردازش</span>
                                @break
                            @case('completed')
                                <span class="text-green-600 font-semibold">تکمیل شده</span>
                                @break
                            @case('cancelled')
                                <span class="text-red-600 font-semibold">لغو شده</span>
                                @break
                            @default
                                <span class="text-gray-600">{{ $order->status }}</span>
                        @endswitch

                    </td>

                    <td class="p-3">
                        {{ $order->created_at->format('Y-m-d') }}
                    </td>

                    <td class="p-3">

    <a href="{{ route('admin.orders.show', $order->id) }}"
       class="text-blue-600 text-sm">
        مشاهده
    </a>

    <form method="POST"
          action="{{ route('admin.orders.destroy', $order->id) }}"
          class="inline"
          onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این سفارش حذف شود؟')">
        @csrf
        @method('DELETE')

        <button class="text-red-600 text-sm">
            حذف
        </button>
    </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        سفارشی ثبت نشده است.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="mt-6">
        {{ $orders->withQueryString()->links() }}
    </div>

</div>

@endsection