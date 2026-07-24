<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::where('status', true)
            ->latest()
            ->take(8)
            ->get();

        $specialProducts = Product::whereNotNull('sale_price')
            ->where('status', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('status', true)
            ->whereNull('parent_id')
            ->take(10)
            ->get();
        $sliders = \App\Models\Slider::where('status', true)
            ->orderBy('sort_order')
            ->get();
        $amazingProducts = Product::where('status', true)
    ->where(function ($q) {
        $q->whereNotNull('sale_price')
          ->orWhereIn('badge', ['special', 'bestseller']);
    })
    ->take(12)
    ->get();
        return view('front.home', compact(
            'latestProducts',
            'specialProducts',
            'categories',
            'sliders',
            'amazingProducts'
        ));
    }
}