@extends('admin.layouts.app')

@section('title', 'مدیریت محصولات')
@section('page-title', 'مدیریت محصولات')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="w-1/3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="جستجوی محصول..."
                   class="w-full px-4 py-2 border rounded-lg">
        </form>

        <a href="{{ route('admin.products.create') }}"
           class="bg-brand px-6 py-2 rounded-lg hover:bg-brand-hover transition">
            افزودن محصول
        </a>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3 text-right">تصویر</th>
                    <th class="p-3 text-right">نام</th>
                    <th class="p-3 text-right">دسته</th>
                    <th class="p-3 text-right">قیمت</th>
                    <th class="p-3 text-right">موجودی</th>
                    <th class="p-3 text-right">عملیات</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)
                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- Image -->
                        <td class="p-3">
                            <img src="{{ $product->image_url }}"
                                 class="w-14 h-14 object-cover rounded-lg">
                        </td>

                        <!-- Name -->
                        <td class="p-3 font-medium">
                            {{ $product->name }}
                        </td>

                        <!-- Category -->
                        <td class="p-3">
                            {{ $product->category->name ?? '-' }}
                        </td>

                        <!-- Price -->
                        <td class="p-3">

                            @if($product->isOnSale())
                                <span class="text-gray-400 line-through block text-xs">
                                    {{ number_format($product->price) }}
                                </span>

                                <span class="text-red-600 font-bold">
                                    {{ number_format($product->sale_price) }}
                                </span>
                            @else
                                <span class="text-green-600 font-bold">
                                    {{ number_format($product->price) }}
                                </span>
                            @endif

                        </td>

                        <!-- Stock -->
                        <td class="p-3">

                            @if($product->stock > 5)
                                <span class="text-green-600 font-semibold">
                                    {{ $product->stock }}
                                </span>
                            @elseif($product->stock > 0)
                                <span class="text-yellow-600 font-semibold">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="text-red-600 font-semibold">
                                    0
                                </span>
                            @endif

                        </td>

                        <!-- Actions -->
                        <td class="p-3 space-x-2 space-x-reverse">

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-blue-600 hover:underline text-sm">
                                ویرایش
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.products.destroy', $product->id) }}"
                                  class="inline-block"
                                  onsubmit="return confirm('حذف شود؟')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">
                                    حذف
                                </button>
                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500">
                            محصولی یافت نشد.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>

</div>

@endsection