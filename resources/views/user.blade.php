<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>

    <!-- Include necessary stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Google Fonts - Poppins -->
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'
        rel='stylesheet'>

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

        .table {
            font-size: 13px;
            /* Smaller font size for table content */
        }

        .table th {
            font-weight: bold;
            text-align: center;
            /* Center align text */
            vertical-align: middle;
            /* Center align vertically */
        }

        .table td {
            text-align: center;
            /* Center align text */
            vertical-align: middle;
            /* Center align vertically */
        }

        .btn {
            font-size: 12px;
            /* Smaller font size for buttons */
        }
    </style>
</head>
<!-- Include the sidebar -->
@include('sidebar')

<body style="background-color: #ECF0F1;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#"
                style="font-family: Arial, sans-serif; font-size: 42px;"><strong>User</strong></a>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="archive-container">
                    <button class="btn btn-success archive-btn" data-bs-toggle="modal" data-bs-target="#archiveModal">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add User
                </button>
            </div>
        </div>

        <div class="container mt-5">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width: 35%; font-size: 15px;">Username</th>
                        <th style="width: 15%; font-size: 15px;">Status</th>
                        <th style="width: 35%; font-size: 15px;">Department</th>
                        <th style="width: 10%; font-size: 15px;">Window</th>
                        <th style="width: 5%; font-size: 15px;">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>user1</td>
                        <td>Active</td>
                        <td>HR</td>
                        <td>Window 1</td>
                        <td><button class="btn btn-danger"><i class="fas fa-trash-alt small-icon"></i></button></td>
                    </tr>
                    <tr>
                        <td>user2</td>
                        <td>Inactive</td>
                        <td>Finance</td>
                        <td>Window 2</td>
                        <td><button class="btn btn-danger"><i class="fas fa-trash-alt small-icon"></i></button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Include necessary scripts -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JavaScript -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <!-- Your custom JavaScript -->
        <script>
            $(document).ready(function () {
            $('#dataTable').DataTable({
                paging: true,
                searching: true
            });
        });
        </script>
</body>

</html>