<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart; // Assuming you have a Cart model

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }
    public function add(Request $request, $product_id)
{
    $quantity = $request->input('quantity', 1);
    $userId = auth()->id();

    // Check if product already in cart
    $cartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $product_id)
                    ->first();

    if ($cartItem) {
        // Update quantity
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // Create new cart item
        Cart::create([
            'user_id' => $userId,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
    }

    return redirect()->route('cart.show');
}
public function show()
{
    $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
    return view('Cart', compact('cartItems'));
}
public function checkout()
{
    // You can handle checkout logic here

    return view('checkout'); // return checkout page view
}
public function remove($id)
{
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();

    return redirect()->back()->with('success', 'Product removed from cart.');
}
}
