@extends('admin.layouts.app')

@section('title', 'افزودن اسلاید')
@section('page-title', 'افزودن اسلاید جدید')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">

<form method="POST"
      action="{{ route('admin.sliders.store') }}"
      enctype="multipart/form-data"
      class="space-y-6">

    @csrf

    <div>
        <label class="block mb-2">عنوان</label>
        <input type="text" name="title"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">لینک</label>
        <input type="text" name="link"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">ترتیب</label>
        <input type="number" name="sort_order"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">تصویر</label>
        <input type="file" name="image"
               class="w-full px-4 py-2 border rounded-lg"
               required>
    </div>

    <div class="flex items-center gap-3">
        <input type="checkbox" name="status" checked>
        <label>فعال</label>
    </div>

    <button class="bg-brand px-6 py-3 rounded-lg">
        ذخیره
    </button>

</form>

</div>

@endsection