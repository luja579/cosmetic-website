@extends('layout.master')

@section('content')
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .form-container {
            width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2.5rem;
            font-weight: bold;
            color: #4B1D8F;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"],
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-footer {
            text-align: center;
            margin-top: 15px;
        }
        .form-footer a {
            color: #28a745;
            text-decoration: none;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
         input[type="text"] {
            text-transform: none !important;
        }
        input[type="email"] {
            text-transform: lowercase;
        }
    </style>
</head>

<body>
<div class="form-container">
    <h2>Login</h2>

    {{-- Display Errors --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" required />
        </div>

        <div class="form-group password-wrapper">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required />
            <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
        </div>

        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>

    <div class="form-footer">
        Don't have an account? <a href="{{ route('register') }}">Register here</a>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
    }
</script>
@endsection
