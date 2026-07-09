@extends('admin.layout.adminmaster')

@section('admincontent')
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
    <label class="block mb-1">Category</label>
    <input type="text" name="category" value="{{ $product->category }}" class="border p-2 w-full bg-gray-100" readonly>
</div>
        <div class="mb-4">
            <label class="block mb-1">Price (Rs.)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Product Image</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="h-24 mb-2">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="border p-2 w-full">
        </div>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Update Product
        </button>
    </form>
</div>
@endsection
