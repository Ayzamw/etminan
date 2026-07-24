@extends('admin.layouts.app')

@section('title', 'مدیریت برند')
@section('page-title', 'مدیریت برند')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="جستجو برند..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <a href="{{ route('admin.brands.create') }}"
           class="bg-brand  px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            افزودن برند
        </a>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام برند</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            @forelse($brands as $brand)
                <tr class="border-b">
                    <td class="p-3 font-medium">
                        {{ $brand->name }}
                    </td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="{{ route('admin.brands.destroy', $brand->id) }}"
                              class="inline"
                              onsubmit="return confirm('حذف شود؟')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 text-sm">
                                حذف
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center p-6 text-gray-500">
                        هنوز برندی ثبت نشده است.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="mt-6">
        {{ $brands->withQueryString()->links() }}
    </div>

</div>

@endsection