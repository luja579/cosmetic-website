@extends('layout.master')

@section('content')
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Payment Details</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>

<div class="container mt-5">

    @if($orders->isEmpty())
        <p>No payments/orders found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>Transaction ID</th> --}}
                    <th>Product </th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Ordered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        {{-- <td>{{ $order->txn_id }}</td> --}}
                        <td>{{ $order->product->name ?? 'Product not found' }}</td>
                        <td>Rs. {{ $order->amount }}</td>
                        <td>{{ ucfirst($order->esewa_status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
    <i class="fa fa-arrow-left"></i> Back to Profile
</a>
</div>
@endsection