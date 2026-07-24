<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', true);

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->latest()->paginate(12);

        $categories = Category::all();
        $brands = Brand::all();

        return view('front.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('front.products.show', compact('product'));
    }
    public function liveSearch(Request $request)
{
    $query = $request->q;

    if (!$query || strlen($query) < 2) {
        return response()->json([]);
    }

    $products = Product::where('status', true)
        ->where('name', 'LIKE', "%{$query}%")
        ->take(8)
        ->get(['id', 'name', 'slug', 'price', 'sale_price', 'image']);

    return response()->json($products);
}
}