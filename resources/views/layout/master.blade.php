<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      {{-- <link rel="shortcut icon" href="assets/images/favicon.png" type="">
      <title>GlowUp</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="assets/css/style.css" rel="stylesheet" /> --}}
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

      <!-- responsive style -->
      {{-- <link href="assets/css/responsive.css" rel="stylesheet" /> --}}
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="/index"><img width="250" src="{{ asset('assets/images/glow.jpg') }}" alt="Glow Logo"" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item ">
                           <a class="nav-link" href="/index">Home <span class="sr-only">
                            {{-- (current) --}}
                        </span></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="/product" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              Products <span class="caret"></span>
                           </a>
                           <ul class="dropdown-menu">
                              <li><a href="/product?category=eye" data-category="eye">Eye</a></li>
                              <li><a href="/product?category=lips" data-category="lips">Lips</a></li>
                              <li><a href="/product?category=face" data-category="face">Face</a></li>
                              <li><a href="/product?category=nails" data-category="nails">Nails</a></li>
                           </ul>
                        </li>
                        
                         

  @guest
<li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('register') }}">
   <i class="fa fa-user-plus fa-fw"></i>Register</a>
</li>
<li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('login') }}">
   <i class="fa fa-sign-in fa-fw"></i>Login</a>
</li>
  @else
  <li class="nav-item dropdown {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" id="dashboardDropdown" role="button"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dashboard <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" aria-labelledby="dashboardDropdown">
    <li><a class="dropdown-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Home</a></li>
    {{-- <li><a class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a></li>
    <li><a class="dropdown-item {{ request()->routeIs('notifications') ? 'active' : '' }}" href="{{ route('notifications') }}">Notifications</a></li> --}}
    <li><div class="dropdown-divider"></div></li>
    <li>
      <a class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
      <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</li>
{{-- <li class="nav-item dropdown {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" id="dashboardDropdown" role="button"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dashboard
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown">
    <a class="dropdown-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
       href="{{ route('dashboard') }}">
      Home
    </a> --}}
    {{-- Uncomment when ready
    <a class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}"
       href="{{ route('profile') }}">
      Profile
    </a>
    <a class="dropdown-item {{ request()->routeIs('notifications') ? 'active' : '' }}"
       href="{{ route('notifications') }}">
      Notifications
      @if (Auth::user()->unreadNotifications->count())
        <span class="badge badge-primary">
          {{ Auth::user()->unreadNotifications->count() }}
        </span>
      @endif
    </a>
    --}}
    {{-- <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </a>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
      @csrf
    </form>
  </div>
</li> --}}
  @endguest
                        <li class="nav-item">
                           <a class="nav-link" href="/cart">
                              <i class="fa fa-credit-card" aria-hidden="true"></i> Payment
                           </a>
                        </li>
                     </ul>
                  </div>
                </nav>
            </div>
         </header>

@yield('content')

      {{-- <footer>
      </footer> --}}
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2025 All Rights Reserved By <span>GlowUp</span><br>
         
         
         </p>
      </div>
      <!-- jQery -->
      {{-- <script src="assets/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="assets/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="assets/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="assets/js/custom.js"></script> --}}
      <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>

      
<script>
document.addEventListener('DOMContentLoaded', function () {
   const navLinks = document.querySelectorAll('.navbar-nav .nav-link, .dropdown-menu a');
   const currentPath = window.location.pathname.split('/').pop();
   const currentCategory = new URLSearchParams(window.location.search).get('category');

   navLinks.forEach(link => {
      const href = link.getAttribute('href');

      // Highlight normal nav links based on path
      if (href === '/' + currentPath || href === currentPath || href === window.location.pathname) {
         link.classList.add('active');
      }

      // Highlight dropdown items based on category query param
      if (link.dataset.category === currentCategory) {
         link.classList.add('active');

         // Highlight parent Products dropdown
         const parentDropdown = link.closest('.nav-item.dropdown');
         if (parentDropdown) {
            const parentLink = parentDropdown.querySelector('.nav-link.dropdown-toggle');
            if (parentLink) parentLink.classList.add('active');
         }
      }
   });
});
</script>

   </body>
</html>