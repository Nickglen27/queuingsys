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


        .background-light {
            background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 2%, rgba(16,185,209,1) 46%, rgba(0,212,255,1) 100%);
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
            padding: 30px;
            border-radius: 8px;
            font-size: 30px;
            width: 100%;
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
            border: 1px solid #ced4da;
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
        .hidden-row {
    display: none;
}
    
        .container {
    margin-left: 120px; /* Adjust the value as needed */    
    }

    #queuingTableBody {
            font-size: 30px; /* Adjust the font size as needed */
            font-weight: bold; /* Make the text bold */
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

    <div class="container">
        <div class="queue-display">
            <h2>Queue Status</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="queue-list">
                        <h3>Next Que</h3>
                        <table id="queuingTable">
                 <thead>
                   <tr>
                  <th>Name</th>
                     <th>Priority Number</th>
                       <th>Window</th>
                 </tr>
             </thead>
         <tbody id="queuingTableBody">
        <!-- Rows will be populated by jQuery -->
            </tbody>
            </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="now-serving">
                        <h1>NOW SERVING</h1>
                        <table>
                        <tr>
    <th>Name:</th>
    <td id="now-serving-name"></td>
</tr>
<tr>
    <th>Department:</th>
    <td id="now-serving-department"></td>
</tr>
<tr>
    <th>Transaction:</th>
    <td id="now-serving-transaction"></td>
</tr>
<tr>
    <th>Window:</th>
    <td id="now-serving-window"></td>
</tr>
<tr>
    <th>Priority Number:</th>
    <td id="now-serving-priority"></td>
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
    let lastData = [];

    function arraysEqual(a, b) {
        if (a.length !== b.length) return false;
        for (let i = 0; i < a.length; i++) {
            if (a[i].studtrans_id !== b[i].studtrans_id) return false;
        }
        return true;
    }

    function populateTable() {
        $.ajax({
            url: '/api/queuing',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (!arraysEqual(response, lastData)) {
                    lastData = response;

                    var tbody = $('#queuingTableBody');
                    tbody.empty();

                    response.forEach(function(item, index) {
                        var row = $('<tr>').addClass('hidden-row'); // Add the hidden-row class for initial hiding

                        if (item.stud_trans && item.stud_trans.student) {
                            var student = item.stud_trans.student;
                            var fullName = student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname;
                            var priorityNum = item.priority_num;
                            var windows = item.stud_trans.windows; // Get windows field

                            row.append($('<td>').text(fullName));
                            row.append($('<td>').text(priorityNum));
                            row.append($('<td>').text(windows)); // Display windows field

                            tbody.append(row);

                            row.fadeIn('slow'); // Use jQuery fadeIn method for the slow fade-in effect
                        }
                    });

                    // Populate the "Now Serving" section with the data of the first item when the table is initially rendered
                    if (response.length > 0) {
                        var firstItem = response[0];
                        var student = firstItem.stud_trans.student;
                        var fullName = student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname;
                        var department = firstItem.stud_trans.department.name; // Access department name
                        var transaction = firstItem.stud_trans.transaction.transaction_type; // Access transaction type
                        var priorityNum = firstItem.priority_num;
                        var windows = firstItem.stud_trans.windows; // Get windows field

                        $('#now-serving-name').text(fullName);
                        $('#now-serving-department').text(department);
                        $('#now-serving-transaction').text(transaction);
                        $('#now-serving-priority').text(priorityNum);
                        $('#now-serving-window').text(windows); // Display windows in "Now Serving" section
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch queuing data:", status, error);
            }
        });
    }

    // Populate the table when the page loads
    populateTable();

    // Optionally, set up polling to refresh the table periodically
    setInterval(populateTable, 5000); // Refresh every 5 seconds
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