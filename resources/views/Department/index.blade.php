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
            .highlight-row {
                background-color: #A7E6FF !important;
                color: white;
            }


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
                width: 150%;
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
                margin-bottom: 10px;
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
                border-bottom: 6px solid #ddd;
            }

            td {
                font-family: 'poppins', sans-serif;
                font-size: 20px;
                padding: 8px;
                border-bottom: 3px solid #ddd;


            }

            .tdnext {
                color: red;
                font-weight: bold;
                font-size: 25px;

            }

            .tdserve {
                color: red;
                font-weight: bold;
                font-size: 23px;

            }

            .green-highlight {
                background-color: green;
                color: white;
            }
        </style>
    </head>

<body style="background-color: #ffffff;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5e0b0e;">
        <div class="container">
            <div class="navbar-brand" href="#">
                @if (Auth::check() && Auth::user()->department && Auth::user()->window)
                    <h1>{{ Auth::user()->department->name }} - Window: {{ Auth::user()->window }}</h1>
                @else
                    <script>
                        window.location.href = "{{ route('login') }}";
                    </script>
                @endif

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
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-top">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green;">
                    <h5 class="modal-title" id="archiveModalLabel" style="font-weight: bold; color: white;">Archive Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Priority No.</th>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 30%;">Transaction</th>
                                <th style="width: 30%;">Status</th>
                                <th style="width: 25%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Archive</button> --}}
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
        // // Define the functions to handle the button clicks
        // function handleCall(id) {
        //     console.log('Call button clicked for row with id: ' + id);
        //     // Add your handling code here
        // }

        // function handleCheck(id) {
        //     console.log('Check button clicked for row with id: ' + id);
        //     // Add your handling code here
        // }

        // function handleArchive(id) {
        //     console.log('Archive button clicked for row with id: ' + id);
        //     // Add your handling code here
        // }

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
                                    '<button class="btn btn-primary" style="width: 80px; height: 30px; margin-right: 8px;" onclick="handleStatus(' +
                                    row.id + ')"><i class="fa fa-phone"></i></button>' +
                                    '<button class="btn btn-success" style="width: 80px; height: 30px; margin-right: 8px;" onclick="isdone(' +
                                    row.id + ')"><i class="fa fa-check"></i></button>' +
                                    '<button class="btn btn-danger" style="width: 80px; height: 30px; margin-right: 8px;" onclick="handleArchiveButtonClick(' +
                                    row.id + ')"><i class="fa fa-archive"></i></button>' +
                                    '<button class="btn btn-warning" style="width: 80px; height: 30px;" onclick="handleTransfer(' +
                                    row.id + ')"><i class="fa fa-exchange"></i></button>' +
                                    '</div>';
                            }


                        }
                    ]
                });
                // Highlight rows where is_call is equal to 1
                $('#TransactionTable tbody tr').each(function() {
                    var rowData = $('#TransactionTable').DataTable().row(this).data();
                    if (rowData && rowData.is_call === 1) {
                        $(this).addClass('highlight-row');
                    }
                });
            }


            // Call fetchTransactions initially when the page loads
            fetchTransactions();

            // Refresh the data every 5 seconds
            setInterval(fetchTransactions, 2000); // 5000 milliseconds = 5 seconds
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
                url: '/update-call/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_call: 1, // Always set is_call to 1
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);

                    // Highlight the row if is_call is 1
                    if (response.is_call === 1) {
                        var table = $('#TransactionTable').DataTable();
                        var rowIndex = response.rowIndex;
                        table.row(rowIndex).node().classList.add('blue-row');
                    }
                },
                error: function(xhr) {
                    // Handle error response
                    console.error(xhr.responseText);

                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'You can only call one at a time.'
                    });
                }
            });
        }

        function isdone(id) {
            // Show confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to mark this task as done?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark it as done!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to update the status
                    $.ajax({
                        url: '/update-done/' + id,
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
                            // Optionally, provide feedback to the user
                            Swal.fire(
                                'Success!',
                                'Task marked as done successfully.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            // Handle error response
                            console.error(xhr.responseText);
                            // Show error message
                            Swal.fire(
                                'Error!',
                                'You need to call it first before marking as done.',
                                'error'
                            );
                        }
                    });
                }
            });
        }


        function handleArchiveButtonClick(id) {
            // Perform AJAX request to update the archive
            $.ajax({
                url: '/update-archive/' + id,
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
                    // Show Swal notification
                    Swal.fire({
                        title: "Success",
                        text: "Task archived successfully!",
                        icon: "success",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    // Handle error response
                    console.error(xhr.responseText);
                    // Show SweetAlert notification
                    Swal.fire({
                        title: "Error",
                        text: "You need to call it first before Archiving it",
                        icon: "error",
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }


        function handleUnArchiveButtonClick(id, is_archive) {
            // Get CSRF token value
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request to update the 'is_archive' value
            $.ajax({
                url: '/update-unarchive/' + id, // Update the URL to match your backend endpoint
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
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error updating is_archive value:', error);
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

        // Define the handleTransfer function
        function handleTransfer(id) {
            // Populate the department select dropdown
            populateDepartmentSelect();

            Swal.fire({
                title: 'Transfer Confirmation',
                html: `
        <form id="transferForm">
            <div class="form-group">
                <label for="transferDropdown">Select a department:</label>
                <select class="form-control" id="transferDropdown">
                    <!-- Departments will be dynamically populated here -->
                </select>
            </div>
            <div class="form-group">
                <label for="transactionsDropdown">Select transaction:</label>
                <select class="form-control" id="transactionsDropdown">
                    <!-- Transactions will be dynamically populated here -->
                </select>
            </div>
        </form>
        `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, transfer it!',
                preConfirm: () => {
                    const selectedDepartment = document.getElementById('transferDropdown').value;
                    const selectedTransaction = document.getElementById('transactionsDropdown').value;
                    return {
                        department: selectedDepartment,
                        transaction: selectedTransaction
                    };
                },
                customClass: {
                    container: 'bigger-swal-modal'
                },
                heightAuto: false,
                width: '40rem', // Adjust the width as needed
                onOpen: () => {
                    // Populate transactions dropdown when the department is selected
                    $('#transferDropdown').change(function() {
                        const selectedDepartment = $(this).val();
                        fetchTransactionsByDepartment(selectedDepartment);
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedDepartment = result.value.department;
                    const selectedTransaction = result.value.transaction;
                    console.log("Transfer confirmed for row with id:", id, "Selected department ID:",
                        selectedDepartment, "Selected transaction:", selectedTransaction);
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Call the API to update the department and transaction
                    $.ajax({
                        url: '/transfer/' + id + '/' + selectedDepartment + '/' + selectedTransaction,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in request headers
                        },
                        success: function(response) {
                            // Handle success response
                            Swal.fire(
                                'Transferred!',
                                'The item has been transferred.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            // Handle error response
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to transfer. Error: ' + xhr.responseText
                            });
                        }
                    });
                }
            });
        }


        // Function to populate the transactions dropdown based on the selected department
        function fetchTransactionsByDepartment(departmentId) {
            $.ajax({
                url: `/transactions/by-department/${departmentId}`,
                method: 'GET',
                success: function(response) {
                    let transactionOptions = '<option value="">Select transaction</option>';
                    response.transactions.forEach(function(transaction) {
                        transactionOptions += `
                    <option value="${transaction.id}">${transaction.transaction_type}</option>
                `;
                    });
                    $('#transactionsDropdown').html(transactionOptions);
                },
                error: function(xhr) {
                    $('#transactionsDropdown').html('<option value="">No Available Transaction Type</option>');
                }
            });
        }

        // Function to populate the department select dropdown
        function populateDepartmentSelect() {
            $.ajax({
                url: '{{ route('departments.all') }}',
                method: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#transferDropdown').empty();
                    // Populate options with departments fetched from the server
                    response.departments.forEach(function(department) {
                        $('#transferDropdown').append($('<option>', {
                            value: department.id,
                            text: department.name
                        }));
                    });
                },
                error: function(xhr) {
                    // Handle error with SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to fetch departments. Error: ' + xhr.responseText
                    });
                }
            });
        }












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
                    title: 'Priority Number'
                },
                {
                    data: 'student.Firstname',
                    title: 'Student Firstname'
                },
                {
                    data: 'transaction.transaction_type',
                    title: 'Transaction Type'
                },
                {
                    data: 'is_done',
                    title: 'Status',
                    render: function(data, type, row) {
                        return (data == 1) ? '<span class="badge bg-success">Done</span>' :
                            '<span class="badge bg-warning">Pending</span>';
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    render: function(data, type, row) {
                        var isDoneButtonDisabled = (data.is_done == 1) ? 'disabled' : '';
                        return '<button class="btn btn-success mr-2" style="width: 80px; height: 30px;" onclick="handleUnArchiveButtonClick(' +
                            data.id + ',' + data.is_archive + ')" ' + isDoneButtonDisabled +
                            '><i class="fa fa-undo"></i></button>';
                    }

                }
            ];

            // Initialize DataTable
            $('#archiveModal table').DataTable({
                destroy: true, // Destroy existing datatable before reinitializing
                paging: false, // Remove pagination
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
