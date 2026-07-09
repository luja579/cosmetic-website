@extends('layout.master')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Payment Failed</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="alert alert-danger">
    <h4>Payment Failed</h4>
    <p>{{ $error }}</p>
</div>

<a href="{{ route('checkout') }}" class="btn btn-primary">Try Again</a>
@endsection