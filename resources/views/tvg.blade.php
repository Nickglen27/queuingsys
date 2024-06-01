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
            height: 650px;
            border: 4px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 0px;
        }

        .left-box {
            width: 100%;
            /* Adjusted to fit the content better */
        }

        .right-box {
            width: 145%;
            /* Adjusted to fit the content better */
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .header-title {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 15px;
            background-color: yellow;
            border-radius: 5px;
            color: #000000;
        }

        .header-right {
            background-color: yellow;
            padding: 10px;
            text-align: center;
        }

        .header-right h2 {
            margin: 0;
            color: black;
            font-size: 28px;
        }

        .container {
            max-width: 95%;
            /* Adjust container max width to fit content better */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            font-family: Arial, sans-serif;
            /* Change the font-family as needed */
            font-size: 24px;
            /* Change the font-size as needed */
            font-weight: bold;
            /* You can change it to normal if you prefer */
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        td {
            font-family: Arial, sans-serif;
            font-size: 20px;
            padding: 8px;
            border-bottom: 3px solid #ddd;
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

    <div class="container mt-10">
        <div class="row">
            <div class="col-md-8">
                <!-- Adjusted column width to match layout -->
                <div class="white-box left-box">
                    <div class="header-title">QUEUING SERVING</div>
                    <div class="table-responsive-xl">
                        <!-- Added xl responsive class here -->
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Window</th>
                                    <th style="width: 25%;">Name</th>
                                    <th style="width: 15%;">Department</th>
                                    <th style="width: 25%;">Transaction</th>
                                    <th style="width: 25%;">Prio Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample data rows can be added here -->

                                <tr>
                                    <td>1</td>
                                    <td>Mark Magsayo</td>
                                    <td>Cashier</td>
                                    <td>Tuition</td>
                                    <td>12</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Mark Magsayo</td>
                                    <td>Cashier</td>
                                    <td>Tuition</td>
                                    <td>42</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Adjusted column width to match layout -->
                <div class="white-box right-box">
                    <div class="header-right">
                        <h2><b>Next Queuing</b></h2>
                    </div>
                    <div class="table-responsive-xl">
                        <!-- Added xl responsive class here -->
                        <table id="nextQueuingTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 1%;"></th> <!-- Adjust width as needed -->
                                    <th style="width: 50%;"><b>Name</b></th> <!-- Adjust width as needed -->
                                    <th style="width: 49%;"><b>Prio Number</b></th> <!-- Adjust width as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>18</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Jane Smith</td>
                                    <td>18</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Jane Smith</td>
                                    <td>18</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Content for the right box -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable, #nextQueuingTable').DataTable({
                "dom": 't', // This removes the search and entries options
                "paging": false, // This disables pagination
                "info": false, // This disables the "Showing X of Y entries" info
                "ordering": false // Disable sorting
            });
        });

        

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