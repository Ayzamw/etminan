@extends('admin.layouts.app')

@section('title', 'ویرایش برند')
@section('page-title', 'ویرایش برند')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-xl">

    <form method="POST"
          action="{{ route('admin.brands.update', $brand->id) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 font-semibold">نام برند</label>
            <input type="text"
                   name="name"
                   value="{{ $brand->name }}"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <button class="bg-brand px-6 py-3 rounded-lg hover:bg-brand-hover transition">
            ذخیره تغییرات
        </button>

    </form>

</div>

@endsection