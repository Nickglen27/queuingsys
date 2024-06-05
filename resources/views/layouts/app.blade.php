<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laragon') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 2px solid #1a1a1a;
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

        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .py-4 {
            background-color: #d3bccc;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #000000;
        }

        .navbar-nav .nav-item .nav-link[href="{{ route('login') }}"]:hover,
        .navbar-nav .nav-item .nav-link[href="{{ route('register') }}"]:hover {
            color: #000000;
        }

        .navbar-nav .nav-item:hover {
            border-bottom: 2px solid #000000;
        }
    </style>
</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+63CT6eS1gEPv8zjvp3mh9TB6a9zFpV5P8rBwVvq+n5+80VnpvO+2zCxgT" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            if (!window.location.pathname.includes('login')) {
                dropdowns.forEach(function(dropdown) {
                    dropdown.addEventListener('click', function() {
                        var menu = dropdown.nextElementSibling;
                        if (menu.classList.contains('show')) {
                            menu.classList.remove('show');
                        } else {
                            menu.classList.add('show');
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>
