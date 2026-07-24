@extends('admin.layouts.app')

@section('title', 'ویرایش محصول')
@section('page-title', 'ویرایش محصول')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

<form method="POST"
      action="{{ route('admin.products.update', $product->id) }}"
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-2 font-semibold">نام محصول</label>
        <input type="text" name="name"
               value="{{ $product->name }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-semibold">قیمت</label>
        <input type="number" name="price"
               value="{{ $product->price }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-semibold">قیمت ویژه</label>
        <input type="number" name="sale_price"
               value="{{ $product->sale_price }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-semibold">موجودی</label>
        <input type="number" name="stock"
               value="{{ $product->stock }}"
               class="w-full px-4 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-semibold">تصویر</label>
        <input type="file" name="image"
               class="w-full px-4 py-2 border rounded-lg">

        <img src="{{ $product->image_url }}"
             class="w-32 mt-4 rounded">
    </div>

    <div>
        <label class="block mb-2 font-semibold">توضیحات</label>
        <textarea name="description"
                  class="w-full px-4 py-2 border rounded-lg"
                  rows="4">{{ $product->description }}</textarea>
    </div>

    <button class="bg-brand text-white px-6 py-3 rounded-lg">
        ذخیره تغییرات
    </button>

</form>

</div>

@endsection