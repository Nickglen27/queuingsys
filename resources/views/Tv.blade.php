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

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .background-light {
            background: #0a2342;
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
            font-family: 'Oregon', sans-serif;
            animation: bounce 2s infinite;
            font-size: 40px;
            font-weight: bold;
            color: rgb(255, 253, 253);
        }

        .custom-button {
            float: right;
            margin-top: 5px;
        }

        .timezone {
            font-size: 40px;
            font-family: 'poppins', sans-serif;
            color: rgb(255, 255, 255);
            margin-right: 20px;
            margin-top: 10px;
        }

        .card {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            /* Add shadow effect */
            transition: box-shadow 0.3s ease;
            /* Smooth transition on hover */
        }

        .card:hover {
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
            /* Increase shadow on hover */
        }

        .white-box {
            background-color: rgb(255, 255, 255);
            width: 90%;
            height: 650px;
            margin: auto;
            border: 2px solid #ccc;
            border-radius: 20px;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
            overflow: auto;
            /* Add scroll if content exceeds */
        }

        .custom-hr {
            border: none;
            height: 3px;
            /* Height of the line */
            background-color: #000;
            /* Color of the line */
            width: 100%;
            /* Width of the line */
            margin: 20px auto;
            /* Center the line */
        }

        .number-input {
            border: none;
            background-color: transparent;
            color: red;
            font-size: 36px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        .text-input {
            border: none;
            background-color: transparent;
            color: rgb(21, 168, 21);
            font-size: 30px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc {
            background-color: #0a2342;
            color: white;
        }

        #sampleTable th,
        #sampleTable td {
            text-align: center;
        }
    </style>
</head>

<body class="background-light">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>Queuing</h1>
            </a>
            <strong>
                <div class="timezone"><span id="beijing-time"></span></div>
            </strong>
        </div>
    </nav>

    <div class="white-box">
        <div class="container mt-4">
            <!-- First row of cards -->
            <div class="row justify-content-center">
                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-7" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 1</b></h1> <!-- Centered title -->
                            <input type="text" class="text-input" value="" readonly>
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 2</b></h1> <!-- Centered title -->
                            <input type="text" class="text-input" value="" readonly>

                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" class="number-input" value="" readonly>

                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 3</b></h1> <!-- Centered title -->
                            <input type="text" class="text-input" value="" readonly>

                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 4</b></h1> <!-- Centered title -->
                            <input type="text" class="text-input" value="" readonly>
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DataTable -->
            <table id="sampleTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Transaction</th>
                        <th>Priority Number</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Finance</td>
                        <td>Deposit</td>
                        <td>58</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>HR</td>
                        <td>Recruitment</td>
                        <td>58</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Michael Brown</td>
                        <td>IT</td>
                        <td>Support</td>
                        <td>58</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sarah Johnson</td>
                        <td>Sales</td>
                        <td>Customer Service</td>
                        <td>58</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        $(document).ready(function() {
            $('#sampleTable').DataTable();
        });
    </script>

</body>

</html>
