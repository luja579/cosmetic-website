@extends('admin.layout.adminmaster')

@section('admincontent')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Products</h2>
    <a href="{{ route('admin.products.create') }}" class="mb-4 inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Add Product</a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <thead>
                <tr>
                    {{-- <th class="py-2 px-4 border-b">ID</th> --}}
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Category</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Stock</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    {{-- <td class="py-2 px-4 border-b">{{ $product->id }}</td> --}}
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->category }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->description }}</td>
                    <td class="py-2 px-4 border-b">Rs.{{ $product->price }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="h-12 w-12 object-cover rounded">
                        @else
                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="No Image" class="h-12 w-12 object-cover rounded">
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:underline">Edit</a> |
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection