@extends('layout.master')

@section('content')
<head>
    <title>Register</title>
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
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"],
        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #218838;
        }
        .form-footer {
            text-align: center;
            margin-top: 15px;
        }
        .form-footer a {
            color: #007bff;
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
    <h2>Create Account</h2>

    {{-- Display Validation Errors Here --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input id="first_name" type="text" name="first_name" required />
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input id="last_name" type="text" name="last_name" required />
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" required />
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input id="phone" type="number" name="phone" required maxlength="10" />
        </div>

        <div class="form-group password-wrapper">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required />
            <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
        </div>

        <div class="form-group">
            <label for="province">Province</label>
            <input id="province" type="text" name="province" required />
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input id="city" type="text" name="city" required />
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input id="postal_code" type="text" name="postal_code" required />
        </div>

        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>

    <div class="form-footer">
        Already have an account? <a href="{{ route('login') }}">Login here</a>
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
