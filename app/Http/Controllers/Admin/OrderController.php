<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('search')) {
            $query->where('customer_name', 'LIKE', '%' . $request->search . '%');
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'وضعیت سفارش بروزرسانی شد');
    }
    public function destroy(Order $order)
{
    $order->delete();

    return redirect()->route('admin.orders.index')
        ->with('success', 'سفارش حذف شد ✅');
}
}