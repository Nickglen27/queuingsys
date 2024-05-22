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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

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
            font-size: 40px;
            font-weight: bold;
            color: rgb(255, 253, 253);
        }

        .custom-button {
            float: right;
            margin-top: 10px;
        }

        .timezone {
            font-size: 30px;
            font-family: 'Roboto', sans-serif;
            color: rgb(255, 255, 255);
            margin-right: 20px;
            margin-top: 15px;
        }

        .queue-display {
            margin: 20px;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            font-size: 24px;
            /* Adjust the font size as needed */
        }

        .queue-display h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 60px;
        }

        .queue-list table {
            width: 100%;
            margin-top: 10px;
            text-align: left;
            border-collapse: collapse;
        }

        .queue-list table th,
        .queue-list table td {
            padding: 15px;
            border: 2px solid #ced4da;
        }

        .queue-list table th {
            background-color: #e9ecef;
        }

        .now-serving {
            background-color: #d1e7dd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }

        .now-serving h1 {
            font-size: 45px;
        }

        .now-serving table {
            width: 100%;
            margin-top: 10px;
            text-align: left;
        }

        .now-serving table th,
        .now-serving table td {
            padding: 25px;
            text-align: left;
            font-size: 27px;
        }
    </style>
</head>

<body style="background-color: #fbfbfb;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #055508;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>Queuing</h1>
            </a>
            <strong>
                <div class="timezone"><span id="beijing-time"></span></div>
            </strong>
        </div>
    </nav>

    <div class="container">
        <div class="queue-display">
            <h2>Queue Status</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="queue-list">
                        <h3>Next Que</h3>
                        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Priority Number</th>
            </tr>
        </thead>
        <tbody id="queuingTableBody">
            <!-- Rows will be populated here by jQuery -->
        </tbody>
    </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="now-serving">
                        <h1>NOW SERVING</h1>
                        <table>
                            <tr>
                                <th>Department:</th>
                                <td>Cashier</td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>Chiwan Valmores</td>
                            </tr>
                            <tr>
                                <th>Transaction:</th>
                                <td>Tuition</td>
                            </tr>
                            <tr>
                                <th>Window:</th>
                                <td>4</td>
                            </tr>
                        </table>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>




 $(document).ready(function() {
            function populateTable() {
                $.ajax({
                    url: '/api/queuing',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var tbody = $('#queuingTableBody');
                        tbody.empty();

                        response.forEach(function(item) {
                            var row = $('<tr>');

                            if (item.stud_trans && item.stud_trans.student) {
                                var student = item.stud_trans.student;
                                var fullName = student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname;
                                var priorityNum = item.priority_num;

                                row.append($('<td>').text(fullName));
                                row.append($('<td>').text(priorityNum));

                                tbody.append(row);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch queuing data:", status, error);
                    }
                });
            }

            // Populate the table when the page loads
            populateTable();
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