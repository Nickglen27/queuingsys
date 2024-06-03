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
            .modal-top {
                margin-top: 10%;
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
                font-size: 28px;
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
        <table id="TransactionTable" class="table table-striped table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 12%;">Priority No.</th>
                    <th class="text-center" tyle="width: 33%;">Name</th>
                    <th class="text-center" style="width: 30%;">Transaction</th>
                    <th class="text-center" style="width: 25%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by DataTables -->
            </tbody>
        </table>

    </div>

    <!-- Modal for Archiving -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green;">
                    <h2 class="modal-title" id="archiveModalLabel" style="font-weight: bold; color: white;">Archive Data
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 12%;">Priority No.</th>
                                <th class="text-center" tyle="width: 33%;">Name</th>
                                <th class="text-center" style="width: 30%;">Transaction</th>
                                <th class="text-center" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 10%;">Actions</th>
                            </tr>

                        </thead>
                        <tbody></tbody>
                    </table>
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
        // Define the functions to handle the button clicks
        function handleCall(id) {
            console.log('Call button clicked for row with id: ' + id);
            // Add your handling code here
        }

        function handleCheck(id) {
            console.log('Check button clicked for row with id: ' + id);
            // Add your handling code here
        }

        function handleArchive(id) {
            console.log('Archive button clicked for row with id: ' + id);
            // Add your handling code here
        }

        $(document).ready(function() {
            // Function to fetch transactions
            function fetchTransactions() {
                $.ajax({
                    url: '/FetchTransactions',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Transaction data retrieved successfully:', response);
                        // Filter out transactions where is_done is equal to 1
                        var filteredData = response.data.filter(function(transaction) {
                            return transaction.is_done !== 1;
                        });
                        initializeDataTable(filteredData);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching transaction data:', textStatus, errorThrown);
                    }
                });
            }

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
   '<button class="btn btn-primary mr-3" style="width: 65px; height: 32px;" onclick="handleStatus(' + row.id + ')">' +
   '<i class="fa fa-phone" style="margin-right: 5px;"></i>&nbsp;</button>' +
   '<button class="btn btn-success mr-3" style="width: 65px; height: 32px;" onclick="isdone(' + row.id + ')">' +
   '<i class="fa fa-check" style="margin-right: 5px;"></i>&nbsp;</button>' +
   '<button class="btn btn-danger mr-3" style="width: 65px; height: 32px;" onclick="handleArchiveButtonClick(' + row.id + ')">' +
   '<i class="fa fa-archive" style="margin-right: 5px;"></i>&nbsp;</button>' +
   '</div>';

                            }

                        }
                    ]
                });
            }

            // Call fetchTransactions initially when the page loads
            fetchTransactions();

            // Refresh the data every 5 seconds
            setInterval(fetchTransactions, 5000); // 5000 milliseconds = 5 seconds
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
        function handleStatus(id) {
    $.ajax({
        url: '/update-status/' + id,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            is_call: 1 // Always set is_call to 1
        },
        success: function(response) {
            // Handle success response, if needed
            console.log(response);
            // Show success message using SweetAlert
            Swal.fire('Call Successful', 'Call has been made successfully!', 'success');
        },
        error: function(xhr) {
            // Handle error response, if needed
            console.error(xhr.responseText);
            // Show error message using SweetAlert
            Swal.fire('Error!', 'Error making the call. Please try again.', 'error');
        }
    });
}


function isdone(id) {
    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to done?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as done!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX request to update the status
            $.ajax({
                url: '/update-status/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_done: 1 // Set is_done to 1 for marking as done
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Remove the row from DataTable
                    removeRowFromDataTable(id);
                    // Show SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Task marked as done successfully!'
                    });
                },
                error: function(xhr) {
                    // Handle error response, if needed
                    console.error(xhr.responseText);
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error marking task as done. Please try again.'
                    });
                }
            });
        }
    });
}


function handleArchiveButtonClick(id) {
    // Display a confirmation dialog using SweetAlert
    Swal.fire({
        title: 'Are you sure?',
        text: 'Once archived, you will not be able to undo this action!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, archive it!',
        cancelButtonText: 'No, cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, perform AJAX request to update the status
            $.ajax({
                url: '/update-status/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_archive: 1 // Set is_archive to 1 for marking as archived
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Remove the row from DataTable
                    removeRowFromDataTable(id);
                    // Show success message using SweetAlert
                    Swal.fire('Archived!', 'Data has been archived.', 'success');
                },
                error: function(xhr) {
                    // Handle error response, if needed
                    console.error(xhr.responseText);
                    // Show error message using SweetAlert
                    Swal.fire('Error!', 'Error marking Data as archived. Please try again.', 'error');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // If user cancels, do nothing
            Swal.fire('Cancelled', 'Task archiving cancelled.', 'info');
        }
    });
        }

        function handleUnArchiveButtonClick(id, is_archive) {
    // Get CSRF token value
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Send an AJAX request to update the 'is_archive' value
    $.ajax({
        url: '/update-status/' + id, // Update the URL to match your backend endpoint
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
        },
        data: {
            is_archive: 0 // Set 'is_archive' value to 0
        },
        success: function(response) {
            // Remove the row from the DataTable
            $('#archiveModal table').DataTable().rows(function(idx, data, node) {
                return data.id == id;
            }).remove().draw();
            // Show success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Unarchived!',
                text: 'Data has been unarchived successfully.'
            });
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error('Error updating is_archive value:', error);
            // Show error message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Error unarchiving task. Please try again.'
            });
        }
    });
}



        // Function to remove the row from DataTable
        function removeRowFromDataTable(id) {
            // Get DataTable instance
            var dataTable = $('#TransactionTable').DataTable();
            // Find the row index by data attribute 'id'
            var rowIndex = dataTable.row($('#TransactionTable tbody tr').filter(function() {
                return $(this).data('id') === id;
            })).index();
            // Remove the row from DataTable
            dataTable.row(rowIndex).remove().draw();
        }
        $(document).ready(function() {
            $('#archiveModal').on('show.bs.modal', function() {
                fetchArchivedAndDone();
            });
        });

        function fetchArchivedAndDone() {
            $.ajax({
                url: '/get-archived-and-done',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Check if the response indicates success and if there are any transactions returned
                    if (response.success && response.data.length > 0) {
                        // Initialize Datatable with column definitions and data
                        initializeDataTable(response.data);
                    } else {
                        // Handle the case where no archived and done records are found
                        console.log('No archived and done records found.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error fetching archived and done records:', error);
                }
            });
        }

        function initializeDataTable(data) {
    // Define DataTable columns
    var columns = [{
            data: 'priority_num',
            title: 'Priority Number',
            className: 'text-center' // Center the data
        },
        {
            data: 'student.Firstname',
            title: 'Student Firstname',
            className: 'text-center' // Center the data
        },
        {
            data: 'transaction.transaction_type',
            title: 'Transaction Type',
            className: 'text-center' // Center the data
        },
        {
            data: 'is_done',
            title: 'Status',
            render: function(data, type, row) {
                return (data == 1) ? '<span class="badge bg-success">Done</span>' :
                    '<span class="badge bg-warning">Pending</span>';
            },
            className: 'text-center' // Center the data
        },
        {
            data: null,
            title: 'Action',
            render: function(data, type, row) {
                var isDoneButtonDisabled = (data.is_done == 1) ? 'disabled' : '';
                return '<button class="btn btn-success mr-2" style="width: 80px; height: 30px;" onclick="handleUnArchiveButtonClick(' +
                    data.id + ',' + data.is_archive + ')" ' + isDoneButtonDisabled +
                    '><i class="fa fa-undo"></i></button>';
            },
            className: 'text-center' // Center the data
        }
    ];

            // Initialize DataTable
            $('#archiveModal table').DataTable({
                destroy: true, // Destroy existing datatable before reinitializing
                paging: true, // Remove pagination
                data: data,
                columns: columns,
                order: [
                    [0, 'desc'] // Sort by the first column (Priority Number) in descending order
                ]
            });

            // Show the modal
            $('#archiveModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        // Call fetchArchivedAndDone to load data on page load or any other event
        fetchArchivedAndDone();


        // Triggered when the modal is about to be shown
        $('#archiveModal').on('show.bs.modal', function(event) {
            // Fetch archived and done records
            fetchArchivedAndDone();
        });
    </script>

</body>

</html>