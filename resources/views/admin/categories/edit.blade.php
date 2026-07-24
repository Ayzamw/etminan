@extends('admin.layouts.app')

@section('title', 'ویرایش دسته‌بندی')
@section('page-title', 'ویرایش دسته‌بندی')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-xl">

    <form method="POST"
          action="{{ route('admin.categories.update', $category->id) }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block mb-2 font-semibold">نام دسته‌بندی</label>
            <input type="text"
                   name="name"
                   value="{{ $category->name }}"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <!-- Parent -->
        <div>
            <label class="block mb-2 font-semibold">دسته والد</label>
            <select name="parent_id"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="">بدون والد</option>

                @foreach($categories as $parent)
                    <option value="{{ $parent->id }}"
                        {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- Current Image -->
        @if($category->image)
            <div>
                <label class="block mb-2 font-semibold">تصویر فعلی</label>
                <img src="{{ $category->image_url }}"
                     class="w-32 rounded-lg">
            </div>
        @endif

        <!-- New Image -->
        <div>
            <label class="block mb-2 font-semibold">تغییر تصویر</label>
            <input type="file"
                   name="image"
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button class="bg-brand  px-6 py-3 rounded-lg hover:bg-brand-hover transition">
            ذخیره تغییرات
        </button>

    </form>

</div>

@endsection