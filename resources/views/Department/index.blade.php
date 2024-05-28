<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Department</title>
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

    <head>

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

            .green-header {
                background-color: green;
            }



            .btn-group {
                display: flex;
                gap: 5px;
                /* Adjust the gap between buttons as needed */
            }

            .btn-yellow {
                background-color: yellow;
                border-color: yellow;
                color: black;
            }

            .btn-blue {
                background-color: blue;
                border-color: blue;
                color: white;
            }



            .action-buttons {
                display: flex;
                gap: 5px;
                /* Adjust the gap between buttons as needed */
            }
        </style>
    </head>

<body style="background-color: #ffffff;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5e0b0e;">
        <div class="container">
            <div class="navbar-brand" href="#">
                <h1>{{ Auth::user()->department->name }} - Window: {{ Auth::user()->window }}</h1>
            </div>
            <strong>
                <div class="timezone"><span id="beijing-time"></span></div>
            </strong>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="archive-container">
                    <button class="btn btn-primary archive-btn" data-bs-toggle="modal" data-bs-target="#archiveModal">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </div>
        </div>
        <table id="TransactionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Priority No.</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">Transaction Type</th>
                    <th class="text-center">Actions</th>

                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by DataTables -->
            </tbody>
        </table>

    </div>

    <!-- Modal for Archiving -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green;">
                    <h5 class="modal-title" id="archiveModalLabel" style="font-weight: bold; color: white;">Archive Data
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 30%;">Transaction</th>
                                <th style="width: 25%;">Department</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Chiwan Florante Valmores</td>
                                <td>Tuition</td>
                                <td>Cashier</td>
                                <td>69</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jhonel Anor Benedicto</td>
                                <td>Enroll</td>
                                <td>Admin</td>
                                <td>169</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Archive</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->

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
        $(document).ready(function() {
            // Function to fetch transactions
            function fetchTransactions() {
                $.ajax({
                    url: '/FetchTransactions',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Transaction data retrieved successfully:', response);
                        initializeDataTable(response.data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching transaction data:', textStatus, errorThrown);
                    }
                });
            }

            // Function to initialize the DataTable
            function initializeDataTable(transactions) {
                $('#TransactionTable').DataTable().clear()
                    .destroy(); // Destroy existing DataTable and clear its data
                $('#TransactionTable').DataTable({
                    data: transactions,
                    columns: [{
                            "data": "priority_num",
                            "className": "text-center"
                        },
                        {
                            "data": "student.Firstname",
                            "className": "text-center"
                        },
                        {
                            "data": "transaction.transaction_type",
                            "className": "text-center"
                        },
                        {
                            "data": null,
                            "title": "Actions",
                            "render": function(data, type, row) {
                                return '<div class="text-center">' +
                                    '<button class="btn btn-primary mr-2" style="width: 100px;"><i class="fa fa-phone"></i></button>' +
                                    '<button class="btn btn-success mr-2" style="width: 100px;"><i class="fa fa-check"></i></button>' +
                                    '<button class="btn btn-danger mr-2" style="width: 100px;"><i class="fa fa-archive"></i></button>' +
                                    '</div>';
                            }
                        }
                    ]
                });
            }

            // Call fetchTransactions initially when the page loads
            fetchTransactions();

            // Refresh the data every 5 seconds
            // setInterval(fetchTransactions, 5000); // 5000 milliseconds = 5 seconds
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

        // // Initialize DataTable
        // $(document).ready(function() {
        //     $('#dataTable').DataTable();
        // });
    </script>

</body>

</html>
