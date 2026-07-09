@extends('layout.master')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Payment Successful</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="alert alert-success">
    <h4>Thank you for your payment!</h4>
    <p>Transaction Code: {{ $transaction['transaction_code'] }}</p>
    <p>Amount: Rs. {{ number_format($transaction['total_amount'], 2) }}</p>
    <p>Status: {{ $transaction['status'] }}</p>
</div>

<a href="{{ url('/index') }}" class="btn btn-primary">Back to Home</a>
@endsection