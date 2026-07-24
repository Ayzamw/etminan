<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سفارش‌های من | اطمینان</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">سفارش‌های من</h1>

    @if($orders->count() > 0)

        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">مبلغ</th>
                    <th class="p-2 border">وضعیت</th>
                    <th class="p-2 border">تاریخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="p-2 border">{{ $order->id }}</td>
                        <td class="p-2 border">{{ number_format($order->total_amount) }} تومان</td>
                        <td class="p-2 border">{{ $order->status }}</td>
                        <td class="p-2 border">{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>شما هنوز سفارشی ثبت نکرده‌اید.</p>
    @endif

</div>

</body>
</html>