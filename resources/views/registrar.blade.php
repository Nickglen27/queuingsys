<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Google Fonts - Oregon -->
    <link href="https://fonts.googleapis.com/css2?family=Oregon&display=swap" rel="stylesheet">

    <style>
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
            font-family: 'Oregon', sans-serif;
            animation: bounce 2s infinite;
            font-size: 28px;
            font-weight: bold;
            color: rgb(255, 253, 253);
            /* Added this line to change text color */
        }

        .custom-button {
            float: right;
            margin-top: 10px;
        }

        .timezone {
            font-size: 18px;
            color: rgb(255, 255, 255);
            margin-right: 20px;
            margin-top: 15px;
        }

        .archive-icon {
            font-size: 24px;
            color: #5e0b0e;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .archive-container {
            text-align: left;
            margin-bottom: 20px;
        }

        /* Center text in table */
        #dataTable th,
        #dataTable td {
            text-align: center;
        }

        /* Adjust width of table headers */
        #dataTable th {
            width: 20%;
            /* Adjust width as needed */
        }
    </style>
</head>

<body style="background-color: #ffffff;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5e0b0e;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>REGISTRAR</h1>
            </a>
            <strong>
                <div class="timezone">Philippine Time: <span id="beijing-time"></span></div>
            </strong>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="archive-container">
                    <button class="btn btn-primary archive-btn">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </div>
        </div>
        <>
            <table id="dataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 30%;">Name</th>
                        <th style="width: 30%;">Transaction</th>
                        <th style="width: 25%;">Department</th>
                        <th style="width: 10%;">Que</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add your data rows here -->
                </tbody>
            </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        // Function to display Beijing time
        function displayBeijingTime() {
            // Get current date and time in Beijing timezone
            var beijingTime = new Date().toLocaleString("en-US", {
                timeZone: "Asia/Shanghai"
            });
            document.getElementById("beijing-time").innerHTML = beijingTime;
        }

        // Update Beijing time every second
        setInterval(displayBeijingTime, 1000);

        // Initialize DataTable
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
