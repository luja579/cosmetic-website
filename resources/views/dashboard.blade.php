{{-- @extends('layout.master')

@section('content')
<div class="container">
  <h1>Welcome, {{ Auth::user()->name }}</h1>
  <p>This is your dashboard.</p>
</div>
@endsection --}}

@extends('layout.master')

@section('content')
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Welcome, {{ $user->first_name }} {{ $user->last_name }}</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>

<div class="container">
  {{-- <h1>Welcome, {{ Auth::user()->name }}</h1> --}}

  <div class="dropdown mt-4">
    <a class="btn btn-secondary " href="{{ route('payments') }}" role="button"
       id="userMenuLink" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-user"></i> Payment Details
    </a>

    {{-- <div class="dropdown-menu" aria-labelledby="userMenuLink">
      <a class="dropdown-item" href="{{ route('profile') }}">
        <i class="fa fa-id-card"></i> Profile
      </a>
 --}}
      {{-- <a class="dropdown-item" href="{{ route('notifications') }}">
        <i class="fa fa-bell"></i> Notifications
        <!-- Optionally show unread count: -->
        <span class="badge badge-primary">{{ $unreadNotifications }}</span>
      </a> --}}
      <div class="container mt-4 p-4 border rounded">
      <p><strong>First Name:</strong> {{ $user->first_name }}</p>
      <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Phone:</strong> {{ $user->phone }}</p>
      <p><strong>Province:</strong> {{ $user->province }}</p>
      <p><strong>City:</strong> {{ $user->city }}</p>
      <p><strong>Postal Code:</strong> {{ $user->postal_code }}</p>

      <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
    </div>
      <div class="dropdown-divider"></div>

      <a class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i> Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    </div>
  </div>
</div>
@endsection