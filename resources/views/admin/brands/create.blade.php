@extends('admin.layouts.app')

@section('title', 'افزودن برند')
@section('page-title', 'افزودن برند جدید')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow max-w-xl">

    <form method="POST"
          action="{{ route('admin.brands.store') }}"
          class="space-y-6">
        @csrf

        <div>
            <label class="block mb-2 font-semibold">نام برند</label>
            <input type="text"
                   name="name"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <button class="bg-brand text-white px-6 py-3 rounded-lg hover:bg-brand-hover transition">
            ذخیره برند
        </button>

    </form>

</div>

@endsection