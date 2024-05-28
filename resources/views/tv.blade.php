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

        .white-box {
            background-color: white;
            width: 90%;
            height: 550px;
            margin: 50px auto;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text">Priority Number:</h5>
                            <h1 style="color: red"><b>28</b></h1>

                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 2</b></h1> <!-- Centered title -->
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text">Priority Number:</h5>
                            <h1 style="color: red"><b>13</b></h1>

                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 3</b></h1> <!-- Centered title -->
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text">Priority Number:</h5>
                            <h1 style="color: red"><b>43</b></h1>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-dark bg-info mb-5" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title"><b>Window 4</b></h1> <!-- Centered title -->
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text">Priority Number:</h5>
                            <h1 style="color: red"><b>52</b></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
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
    </script>

</body>

</html>