@extends('layout.master')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Checkout</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>Rs. {{ number_format($item->product->price, 2) }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rs. {{ number_format($item->product->price * $item->quantity, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end">Total:</th>
            <th>Rs. {{ number_format($total, 2) }}</th>
        </tr>
    </tfoot>
</table>

<form action="{{ route('esewa2') }}" method="POST">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}">
    <button type="submit" class="btn btn-success">Pay with eSewa</button>
</form>
@endsection