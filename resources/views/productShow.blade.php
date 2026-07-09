@extends('layout.master')

@section('content')
<style>
    .product-detail .img-fluid {
        border: 3px solid #e0e7ff; /* subtle light blue border */
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(75, 29, 143, 0.08);
        background: #f8fafc;
        padding: 12px;
        max-width: 100%;
    }
    .product-detail h2 {
        color: #4B1D8F; /* muted purple, eye-catching */
        font-size: 2.3rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .product-detail h4 {
        color: #3A6EA5; /* soft blue for price */
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }
    .product-detail p {
        color: #444;
        font-size: 1.05rem;
        margin-bottom: 1.2rem;
    }
    .product-detail label {
        color: #4B1D8F;
        font-weight: 600;
    }
    .product-detail input[type="number"] {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 4px 10px;
        width: 70px;
        margin-left: 8px;
    }
    .product-detail .btn-primary {
        background: linear-gradient(90deg, #4B1D8F 60%, #3A6EA5 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 6px;
        padding: 8px 24px;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(75, 29, 143, 0.08);
    }
    .product-detail .btn-primary:hover {
        background: linear-gradient(90deg, #3A6EA5 60%, #4B1D8F 100%);
        color: #fff;
    }
    .product-description {
    background: #f3f6fa;
    border-left: 4px solid #3A6EA5;
    padding: 14px 18px;
    border-radius: 8px;
    color: #444;
    margin-bottom: 1.2rem;
}
</style>

<section class="product-detail layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                @else
                    <img src="{{ asset('assets/images/placeholder.png') }}" alt="No Image" class="img-fluid">
                @endif
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <h4>Price: Rs. {{ number_format($product->price, 2) }}</h4>
                <div class="product-description" style="background: #f3f6fa; border-left: 4px solid #3A6EA5; padding: 14px 18px; border-radius: 8px; color: #444; margin-bottom: 1.2rem;">
                    <p style="margin: 0;">{{ $product->description }}</p>
                 </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control w-25 d-inline-block">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection