@extends('admin.layouts.app')

@section('title', 'مدیریت اسلایدر')
@section('page-title', 'مدیریت اسلایدر')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="font-bold text-lg">لیست اسلایدر</h2>

        <a href="{{ route('admin.sliders.create') }}"
           class="bg-brand  px-6 py-2 rounded-lg">
            افزودن اسلاید
        </a>
    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-right">تصویر</th>
                <th class="p-3 text-right">عنوان</th>
                <th class="p-3 text-right">ترتیب</th>
                <th class="p-3 text-right">وضعیت</th>
                <th class="p-3 text-right">عملیات</th>
            </tr>
        </thead>

        <tbody>

            @foreach($sliders as $slider)
                <tr class="border-b">

                    <td class="p-3">
                        <img src="{{ asset('storage/'.$slider->image) }}"
                             class="w-32 rounded-lg">
                    </td>

                    <td class="p-3">
                        {{ $slider->title }}
                    </td>

                    <td class="p-3">
                        {{ $slider->sort_order }}
                    </td>

                    <td class="p-3">
                        @if($slider->status)
                            <span class="text-green-600">فعال</span>
                        @else
                            <span class="text-red-600">غیرفعال</span>
                        @endif
                    </td>

                    <td class="p-3 space-x-2 space-x-reverse">

                        <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                           class="text-blue-600 text-sm">
                            ویرایش
                        </a>

                        <form method="POST"
                              action="{{ route('admin.sliders.destroy', $slider->id) }}"
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
            @endforeach

        </tbody>

    </table>

</div>

@endsection