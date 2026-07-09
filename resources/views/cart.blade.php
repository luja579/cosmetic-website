@extends('layout.master')

@section('content')
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Payment</h3>
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
         @php
            $total = 0;
        @endphp
        @foreach($cartItems as $item)
        @php
                $subtotal = $item->product->price * $item->quantity;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>Rs. {{ number_format($item->product->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rs. {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
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

@if($total == 0)
   <div class="alert alert-danger mt-3 text-center" style="font-size:1.15rem; font-weight:600;">
        <span style="font-size:1.5rem;">&#9888;&#65039;</span>
        <span class="ms-2">You cannot proceed to payment with a total of Rs. 0!</span>
    </div>
@endif

@if($total > 0)
    <div class="text-center mt-3">
        <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Payment</a>
    </div>
@endif
@endsection