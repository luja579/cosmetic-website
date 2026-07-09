<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function edit(Order $order)
    {
        $users = User::all(['id', 'first_name', 'last_name']);
        $products = Product::all(['id', 'name']);
        return view('admin.orders_edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'txn_id' => 'nullable|string|max:255',
            'esewa_status' => 'required|in:pending,completed,failed',
        ]);

        $order->update($request->only(['user_id', 'product_id', 'amount', 'txn_id', 'esewa_status']));

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
    }
}