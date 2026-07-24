@extends('admin.layouts.app')

@section('title', 'داشبورد مدیریت')

@section('page-title', 'داشبورد مدیریت')

@section('content')

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">تعداد محصولات</h3>
        <div class="text-3xl font-bold">
            {{ \App\Models\Product::count() }}
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">تعداد سفارش‌ها</h3>
        <div class="text-3xl font-bold">
            {{ \App\Models\Order::count() }}
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-sm text-gray-500 mb-2">کاربران</h3>
        <div class="text-3xl font-bold">
            {{ \App\Models\User::count() }}
        </div>
    </div>

</div>

@endsection