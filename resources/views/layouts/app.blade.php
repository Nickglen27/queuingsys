<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laragon') }}</title> <!-- Replaced 'Laravel' with 'Laragon' -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .navbar {
            background-color: #fff;
            border-bottom: 2px solid #1a1a1a; /* Add border stroke */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1a1a1a;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.5)' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .navbar-nav .nav-link {
            font-weight: 500;
            color: #1a1a1a;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff;
        }
        .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dropdown-menu a {
            color: #1a1a1a;
            font-weight: 500;
        }
        .dropdown-menu a:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
        .dropdown-item:focus, .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
        .py-4 {
            background-color: #d3bccc; /* Change background color here */
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        /* Custom CSS for hover effect on authentication links */
        .navbar-nav .nav-item .nav-link:hover {
            color: #000000; /* Change hover color to pitch black */
        }
        /* Custom CSS for hover effect on login and register links */
        .navbar-nav .nav-item .nav-link[href="{{ route('login') }}"]:hover,
        .navbar-nav .nav-item .nav-link[href="{{ route('register') }}"]:hover {
            color: #000000; /* Change hover color to pitch black */
        }
        /* Custom CSS for hover effect on login and register border */
        .navbar-nav .nav-item:hover {
            border-bottom: 2px solid #000000; /* Change hover border color to pitch black */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laragon') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+63CT6eS1gEPv8zjvp3mh9TB6a9zFpV5P8rBwVvq+n5+80VnpvO+2zCxgT" crossorigin="anonymous"></script>
    <!-- Bootstrap Dropdown Script -->
    <script>
       // Initialize Bootstrap dropdowns only if not on the login page
    document.addEventListener('DOMContentLoaded', function () {
        var dropdowns = document.querySelectorAll('.dropdown-toggle');
        if (!window.location.pathname.includes('login')) {
            dropdowns.forEach(function (dropdown) {
                dropdown.addEventListener('click', function () {
                    var menu = dropdown.nextElementSibling;
                    if (menu.classList.contains('show')) {
                        menu.classList.remove('show');
                    } else {
                        menu.classList.add('show');
                    }
                });
            });
        }
//             @if(auth()->check())
//     @if(auth()->user()->department === 'Registrar')
//         window.location.href = "{{ route('registration.registrar') }}";
//     @elseif(auth()->user()->department === 'Admin')
//         window.location.href = "{{ route('registration.admin') }}";
//     @elseif(auth()->user()->department === 'Cashier')
//         window.location.href = "{{ route('registration.cashier') }}";
//     @else
//         window.location.href = "{{ url('cashier') }}";
//     @endif
// @endif

        });
    
    </script>
</body>
</html>
