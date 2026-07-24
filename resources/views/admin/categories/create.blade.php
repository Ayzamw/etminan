@extends('admin.layouts.app')

@section('title', 'افزودن دسته‌بندی')
@section('page-title', 'افزودن دسته‌بندی جدید')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-xl">

    <form method="POST"
          action="{{ route('admin.categories.store') }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        <div>
            <label class="block mb-2 font-semibold">نام دسته‌بندی</label>
            <input type="text"
                   name="name"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">دسته والد</label>
            <select name="parent_id"
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="">بدون والد</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold">تصویر دسته</label>
            <input type="file"
                   name="image"
                   class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button class="bg-brand  px-6 py-3 rounded-lg">
            ذخیره دسته‌بندی
        </button>

    </form>

</div>

@endsection