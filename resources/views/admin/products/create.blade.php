@extends('admin.layouts.app')

@section('title', 'افزودن محصول')
@section('page-title', 'افزودن محصول جدید')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">

    <form method="POST"
          action="{{ route('admin.products.store') }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        <!-- Name -->
        <div>
            <label class="block mb-2 font-semibold">نام محصول</label>
            <input type="text"
                   name="name"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <!-- Category -->
        <div>
            <label class="block mb-2 font-semibold">دسته‌بندی</label>
            <select name="category_id"
                    class="w-full px-4 py-2 border rounded-lg"
                    required>
                <option value="">انتخاب کنید</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Brand -->
        <div>
            <label class="block mb-2 font-semibold">برند</label>
            <select name="brand_id"
                    class="w-full px-4 py-2 border rounded-lg"
                    required>
                <option value="">انتخاب کنید</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div>
            <label class="block mb-2 font-semibold">قیمت</label>
            <input type="number"
                   name="price"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <!-- Sale Price -->
        <div>
            <label class="block mb-2 font-semibold">قیمت ویژه</label>
            <input type="number"
                   name="sale_price"
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <!-- Stock -->
        <div>
            <label class="block mb-2 font-semibold">موجودی</label>
            <input type="number"
                   name="stock"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <!-- Badge -->
        <div>
            <label class="block mb-2 font-semibold">برچسب</label>
            <select name="badge"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="">بدون برچسب</option>
                <option value="new">جدید</option>
                <option value="special">ویژه</option>
                <option value="bestseller">پرفروش</option>
            </select>
        </div>

        <!-- Image -->
        <div>
            <label class="block mb-2 font-semibold">تصویر</label>
            <input type="file"
                   name="image"
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-2 font-semibold">توضیحات</label>
            <textarea name="description"
                      rows="4"
                      class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>

        <button class="bg-brand  px-6 py-3 rounded-lg hover:bg-brand-hover transition">
            ذخیره محصول
        </button>

    </form>

</div>

@endsection