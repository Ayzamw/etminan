<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('front.cart.index', compact('cart'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return back()->with('error', 'موجودی این محصول به پایان رسیده است');
        }

        $cart = session()->get('cart', []);

        $quantity = isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1;

        if ($quantity > $product->stock) {
            return back()->with('error', 'موجودی کافی نیست');
        }

        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->final_price,
            "quantity" => $quantity,
            "image" => $product->image_url
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'به سبد اضافه شد ✅');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $request->quantity);
            session()->put('cart', $cart);
        }

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'محصول حذف شد ✅');
    }
}