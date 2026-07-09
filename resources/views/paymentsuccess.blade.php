@extends('layout.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

    <h1>Payment Successful!</h1>
    <p>Thank you for your payment.</p>

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@endsection
