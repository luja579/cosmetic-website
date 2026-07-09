@extends('admin.layout.adminmaster')

@section('admincontent')
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Add Product</h2>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Category</label>
            <select name="category" class="border p-2 w-full" required>
                <option value="">Select Category</option>
                <option value="Eye" {{ old('category') == 'Eye' ? 'selected' : '' }}>Eye</option>
                <option value="Lips" {{ old('category') == 'Lips' ? 'selected' : '' }}>Lips</option>
                <option value="Face" {{ old('category') == 'face' ? 'selected' : '' }}>Face</option>
                <option value="Nails" {{ old('category') == 'Nails' ? 'selected' : '' }}>Nails</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <input type="text" name="description" value="{{ old('description') }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Price (Rs.)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="border p-2 w-full" required>
        </div>  
        <div class="mb-4">
            <label class="block mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Product Image</label>
            <input type="file" name="image" accept="image/*" class="border p-2 w-full">
        </div>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Add Product
        </button>
    </form>
</div>
@endsection
