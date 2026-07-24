@extends('admin.layouts.app')

@section('title', 'ویرایش اسلاید')
@section('page-title', 'ویرایش اسلاید')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">

<form method="POST"
      action="{{ route('admin.sliders.update', $slider->id) }}"
      enctype="multipart/form-data"
      class="space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="block mb-2">عنوان</label>
        <input type="text" name="title"
               value="{{ $slider->title }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">لینک</label>
        <input type="text" name="link"
               value="{{ $slider->link }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">ترتیب</label>
        <input type="number" name="sort_order"
               value="{{ $slider->sort_order }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2">تصویر فعلی</label>
        <img src="{{ asset('storage/'.$slider->image) }}"
             class="w-64 rounded-lg">
    </div>

    <div>
        <label class="block mb-2">تصویر جدید</label>
        <input type="file" name="image"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div class="flex items-center gap-3">
        <input type="checkbox" name="status" {{ $slider->status ? 'checked' : '' }}>
        <label>فعال</label>
    </div>

    <button class="bg-brand px-6 py-3 rounded-lg">
        ذخیره تغییرات
    </button>

</form>

</div>

@endsection