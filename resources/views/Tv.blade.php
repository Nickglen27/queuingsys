<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
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

    {{-- <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"> --}}

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
                        <table id="WindowTable" class="table table-striped">
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
                                {{-- <!-- Sample data rows can be added here -->

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
                                </tr> --}}

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

    {{-- <body class="background-light">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>Queuing</h1>
            </a>
            <strong>
                <div class="timezone"><span id="beijing-time"></span></div>
            </strong>
        </div>
    </nav> --}}

    {{-- <div class="white-box">
        <div class="container mt-4"> --}}
    <!-- First row of cards -->
    {{-- <div class="row justify-content-center"> --}}

    <!-- Card 1 -->
    {{-- <div class="col-lg-3 col-md-6 mb-4" id="window_card_1">
                    <div class="card text-dark bg-info mb-7" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title" id="window_title_1" value=""><b>Loading...</b></h1>
                            <!-- Centered title with loading text -->
                            <!-- Display department_id and priority_num -->
                            <div id="department_and_priority_1"></div>
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" id="priority_num_1" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" id="window_card_2">
                    <div class="card text-dark bg-info mb-7" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <!-- Icon and Title -->
                            <h1 class="card-title" id="window_title_2"><b>Loading...</b></h1>
                            <!-- Centered title with loading text -->
                            <!-- Display department_id and priority_num -->
                            <div id="department_and_priority_2"></div>
                            <!-- Sample data -->
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" id="priority_num_2" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>

                <!-- Repeat the above structure for windows 3 and 4 with appropriate IDs -->
                <div class="col-lg-3 col-md-6 mb-4" id="window_card_3">
                    <div class="card text-dark bg-info mb-7" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <h1 class="card-title" id="window_title_3"><b>Loading...</b></h1>
                            <div id="department_and_priority_3"></div>
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" id="priority_num_3" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" id="window_card_4">
                    <div class="card text-dark bg-info mb-7" style="max-width: 20rem;">
                        <div class="card-body text-center">
                            <h1 class="card-title" id="window_title_4"><b>Loading...</b></h1>
                            <div id="department_and_priority_4"></div>
                            <hr class="custom-hr">
                            <h5 class="card-text"><b>Priority Number:</b></h5>
                            <input type="text" id="priority_num_4" class="number-input" value="" readonly>
                        </div>
                    </div>
                </div> --}}

    <!-- DataTable -->
    {{-- <table id="WindowTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>

                            <th>Priority Number</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table> --}}

    {{-- 
    </div>
    </div> --}}

    <!-- Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JavaScript -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Select2 JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
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
        function fetchAndPopulateTable() {
            let tableData = [];
            let requestsCompleted = 0;

            for (let i = 1; i <= 4; i++) {
                $.ajax({
                    url: '/get-is-call-status/' + i,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.windows && response.departments && response.departments.length > 0 &&
                            response.priority_nums && response.student_details && response.transaction_types) {
                            // Iterate through departments array
                            for (let j = 0; j < response.departments.length; j++) {
                                const departments = response.departments[j];
                                const priority = response.priority_nums[departments][
                                    0
                                ]; // Assuming only one priority per department
                                const studentId = response.student_details[departments][
                                    0
                                ]; // Assuming only one student_id per department
                                const transactionId = response.transaction_types[departments][
                                    0
                                ]; // Assuming only one transaction_id per department
                                tableData.push({
                                    window: response.windows[0], // Assuming only one window
                                    departments: departments,
                                    priority: priority,
                                    student_id: studentId, // Updated key to student_id
                                    transaction_id: transactionId // Added transaction_id
                                });
                            }
                        }

                        requestsCompleted++;

                        if (requestsCompleted === 4) {
                            // After all requests are completed
                            initializeDataTable(tableData);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch data for window ' + i + ':', error);
                        requestsCompleted++;

                        if (requestsCompleted === 4) {
                            // Ensure DataTable initialization if any request fails
                            initializeDataTable(tableData);
                        }
                    }
                });
            }
        }

        function initializeDataTable(tableData) {
            $('#WindowTable').DataTable({
                destroy: true, // Destroy any existing DataTable instance before recreating it
                data: tableData,
                columns: [{
                        data: 'window',
                        render: function(data) {
                            return 'Window ' + data;
                        }
                    },
                    {
                        data: 'student_id'
                    },
                    {
                        data: 'departments'
                    },
                    {
                        data: 'transaction_id' // Add column for transaction_id
                    },
                    {
                        data: 'priority'
                    }
                ],
                dom: 't', // This removes the search and entries options
                paging: false, // This disables pagination
                info: false, // This disables the "Showing X of Y entries" info
                ordering: true, // Enable sorting
                language: {
                    emptyTable: "Empty"
                }, // Custom no data message
                initComplete: function(settings, json) {
                    // Remove the sorting arrows
                    var headers = $(this).DataTable().columns().header();
                    $(headers).removeClass('sorting');
                    $(headers).removeClass('sorting_asc');
                    $(headers).removeClass('sorting_desc');
                }
            });
        }

        $(document).ready(function() {
            fetchAndPopulateTable();
            setInterval(fetchAndPopulateTable, 2000); // Refresh every 5 seconds
        });
    </script>
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


        // function displayDepartmentAndPriority() {
        //     // Iterate over each window
        //     for (let i = 1; i <= 4; i++) {
        //         // Make a GET request to fetch department_id, priority_num, and window title
        //         $.ajax({
        //             url: '/get-is-call-status/' + i,
        //             method: 'GET',
        //             dataType: 'json',
        //             success: function(response) {
        //                 if (response.department_id && response.priority_num) {
        //                     // Update the DOM with the fetched department_id
        //                     $('#department_and_priority_' + i).html('<p><strong>Department ID:</strong> ' +
        //                         response.department_id);

        //                     // Update the priority_num input field
        //                     $('#priority_num_' + i).val(response.priority_num);

        //                     // Update the window title if it exists in the response
        //                     if (response.window_title) {
        //                         $('#window_card_' + i + ' .card-title').html('<b>' + response.window_title +
        //                             '</b>');
        //                     } else {
        //                         // If no window title is returned, display a default title
        //                         $('#window_card_' + i + ' .card-title').html('<b>Window ' + i + '</b>');
        //                     }
        //                 } else {
        //                     // If no data is returned, show a message
        //                     $('#department_and_priority_' + i).html('<p>No data available</p>');

        //                     // Remove the value of the priority_num input field
        //                     $('#priority_num_' + i).val('');

        //                     // Remove the window title
        //                     $('#window_card_' + i + ' .card-title').html('Loading...');
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Failed to fetch data for window ' + i + ':', error);
        //             }
        //         });
        //     }
        // }

        // // Call the function to display department_id and priority_num initially
        // $(document).ready(function() {
        //     displayDepartmentAndPriority();

        //     // Call the function every 5 seconds using setInterval
        //     setInterval(displayDepartmentAndPriority, 5000); // 5000 milliseconds = 5 seconds
        // });
    </script>

</body>

</html>
