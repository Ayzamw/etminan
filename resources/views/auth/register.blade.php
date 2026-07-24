@extends('front.layouts.app')

@section('title', 'ثبت‌نام | اطمینان')

@section('content')

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl">

    <h2 class="text-2xl font-bold mb-6 text-center">
        ایجاد حساب کاربری
    </h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-2 text-sm font-semibold">نام</label>
            <input type="text"
                   name="name"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold">ایمیل</label>
            <input type="email"
                   name="email"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold">رمز عبور</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold">تکرار رمز عبور</label>
            <input type="password"
                   name="password_confirmation"
                   required
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-brand dark:bg-gray-700 dark:border-gray-600">
        </div>

        <button class="w-full bg-brand hover:bg-brand-hover text-white py-3 rounded-xl font-semibold transition shadow-lg">
            ثبت‌نام
        </button>

    </form>

</div>

@endsection