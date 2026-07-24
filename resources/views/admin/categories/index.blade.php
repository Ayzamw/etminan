@extends('admin.layouts.app')

@section('title', 'مدیریت دسته‌بندی')
@section('page-title', 'مدیریت دسته‌بندی')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="جستجو..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <!-- ✅ این همون دکمه‌ایه که لازم داری -->
        <a href="{{ route('admin.categories.create') }}"
           class="bg-brand  px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            + افزودن دسته
        </a>

    </div>

    <!-- Table -->
    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">نام</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            @forelse($categories as $category)
                <tr class="border-b">
                    <td class="p-3">{{ $category->name }}</td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="{{ route('admin.categories.destroy', $category->id) }}"
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
                        هنوز دسته‌ای ثبت نشده است.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

    <div class="mt-6">
        {{ $categories->withQueryString()->links() }}
    </div>

</div>

@endsection