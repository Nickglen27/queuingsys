<!-- File: resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>

    <!-- Include necessary stylesheets -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    {{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="{{ asset('assets/js/sweetalert2@10.js') }}"></script>

    <!-- Google Fonts - Poppins -->
    {{-- <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'
        rel='stylesheet'> --}}
        <link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet">


    <!-- Custom Styles -->
    <style>
        body {
            min-height: 100vh;
            background-color: var(--body-color);
            transition: var(--tran-05);
        }

        .navbar {
            height: 100px;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            animation: bounce 2s infinite;
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>
<!-- Include the sidebar -->
@include('sidebar')

<body style="background-color: #ECF0F1;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#"
                style="font-family: Arial, sans-serif; font-size: 42px;"><strong>Dashboard</strong></a>
        </div>
    </nav>
    <div class="container mt-4">
        <!-- First row of cards -->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-dark bg-warning mb-7" style="max-width: 20rem;">
                    <div class="card-body text-center">
                        <!-- Icon and Title -->
                        <i class="fas fa-building fa-3x mb-3"></i> <!-- Icon based on title "Department" -->
                        <h5 class="card-title">Department</h5> <!-- Centered title -->
                        <!-- Sample data -->
                        <p class="card-text">Total: 50</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                    <div class="card-body text-center">
                        <!-- Icon and Title -->
                        <i class="fas fa-users fa-3x mb-3"></i> <!-- Icon based on title "Users" -->
                        <h5 class="card-title">Users</h5> <!-- Centered title -->
                        <!-- Sample data -->
                        <p class="card-text">Active: 30</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                    <div class="card-body text-center">
                        <!-- Icon and Title -->
                        <i class="fas fa-users fa-3x mb-3"></i> <!-- Icon based on title "Users" -->
                        <h5 class="card-title">Users</h5> <!-- Centered title -->
                        <!-- Sample data -->
                        <p class="card-text">Active: 30</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-dark bg-success mb-5" style="max-width: 20rem;">
                    <div class="card-body text-center">
                        <!-- Icon and Title -->
                        <i class="fas fa-exchange-alt fa-3x mb-3"></i> <!-- Icon based on title "Transaction" -->
                        <h5 class="card-title">Transaction</h5> <!-- Centered title -->
                        <!-- Sample data -->
                        <p class="card-text">Pending: 10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>







</body>






<!-- Include necessary scripts -->
<!-- Bootstrap Bundle with Popper -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables JavaScript -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
<!-- Your custom JavaScript -->
<script>
    // Custom JavaScript for your dashboard interactions
    const body = document.querySelector('body');
    const sidebar = body.querySelector('.sidebar');
    const toggle = sidebar.querySelector('.toggle');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('close');
        body.classList.toggle('sidebar-close');
        body.classList.toggle('sidebar-open');
        const mainContent = document.getElementById('main-content');
        const dataTableContainer = document.getElementById('data-table-container');

        if (sidebar.classList.contains('close')) {
            mainContent.style.marginLeft = '70px';
            dataTableContainer.style.marginLeft = '70px';
        } else {
            mainContent.style.marginLeft = '250px';
            dataTableContainer.style.marginLeft = '250px';
        }
    });

    const modeSwitch = document.querySelector('.toggle-switch');

    modeSwitch.addEventListener('click', () => {
        body.classList.toggle('dark');
        const modeText = document.querySelector('.mode-text');
        modeText.innerText = body.classList.contains('dark') ? 'Light Mode' : 'Dark Mode';
    });
</script>
</body>

</html>
