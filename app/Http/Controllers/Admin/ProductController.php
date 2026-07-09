<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('productShow', compact('product'));
    }
        public function index()
    {
        $products = Product::all();

        
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.product_create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product added!');
  }

        // Create product
    public function edit(Product $product)
    {
        return view('admin.product_edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}