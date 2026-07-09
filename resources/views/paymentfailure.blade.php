@extends('layout.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

    <h1>Payment Failed</h1>
    <p>
        @if(isset($error))
            {{ $error }}
        @else
            Sorry, your payment was not successful. Please try again.
        @endif
    </p>

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@endsection


