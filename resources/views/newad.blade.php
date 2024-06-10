<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    {{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">


    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> --}}
    <link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet">

    <style>
        /* Google Font Import - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            /* ===== Colors ===== */
            --body-color: #E4E9F7;
            --sidebar-color: #FFF;
            --primary-color: #695CFE;
            --primary-color-light: #F6F5FF;
            --toggle-color: #DDD;
            --text-color: #707070;
            /* ====== Transition ====== */
            --tran-03: all 0.3s ease;
            --tran-04: all 0.3s ease;
            --tran-05: all 0.3s ease;
        }

        body {
            min-height: 100vh;
            background-color: var(--body-color);
            transition: var(--tran-05);
        }

        ::selection {
            background-color: var(--primary-color);
            color: #fff;
        }

        /* Navbar */
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
            font-family: 'Poppins', sans-serif;
            animation: bounce 2s infinite;
            font-size: 28px;
            font-weight: bold;
        }

        .table {
            font-size: 13px;
            /* Smaller font size for table content */
        }

        .table th {
            font-weight: bold;
            text-align: center;
            /* Center align text */
            vertical-align: middle;
            /* Center align vertically */
        }

        .table td {
            text-align: center;
            /* Center align text */
            vertical-align: middle;
            /* Center align vertically */
        }

        .btn {
            font-size: 12px;
            /* Smaller font size for buttons */
        }
    </style>
</head>

<!-- Include the sidebar -->
@include('sidebar')

<body style="background-color: #ECF0F1;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#"
                style="font-family: Arial, sans-serif; font-size: 42px;"><strong>Department</strong></a>
        </div>
    </nav>
    <div id="main-content" class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Buttons moved to the right side -->
            <div class="d-flex justify-content-end align-items-center w-100">
                <button class="btn btn-primary custom-button me-3" data-bs-toggle="modal"
                    data-bs-target="#addDepartmentModal">Add Department</button>
                <button class="btn btn-primary custom-button" data-bs-toggle="modal"
                    data-bs-target="#addTransactionModal">Add Transaction</button>
            </div>
        </div>
    </div>

    <br><br><br>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="addDepartmentModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm">
                        @csrf
                        <div class="mb-3">
                            <label for="departmentName" class="form-label" style="font-weight: bold;">Department
                                Name</label>
                            <input type="text" class="form-control" id="departmentName" name="name"
                                placeholder="Enter Department Name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveDepartment">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Transactions Modal -->
    <div class="modal fade" id="viewTransactionsModal" tabindex="-1" aria-labelledby="viewTransactionsModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="viewTransactionsModalLabel">View Transactions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="transactionsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20px;"></th>
                                <th>Transaction Type</th>
                                <th>Action</th> <!-- Add a column for action buttons -->
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody id="transactionsBody">
                            <!-- Transactions will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTransactionForm">
                        <div class="mb-3">
                            <strong><label for="transactionInput" class="form-label">Transaction
                                    Type:</label></strong>
                            <input type="text" class="form-control" id="transactionInput"
                                placeholder="Enter Transaction Type" required>
                        </div>
                        <div class="mb-3">
                            <strong><label for="departmentSelect" class="form-label">Select
                                    Department:</label></strong>
                            <select class="form-control" id="departmentSelect" required>
                                <!-- Departments will be dynamically populated here -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveTransactionBtn">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Transaction Modal -->
    <div class="modal fade" id="editTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="editTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="editTransactionModalLabel" style="color: white;">Edit Transaction
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit transaction details -->
                    <form id="editTransactionForm">
                        <div class="form-group">
                            <label for="editTransactionType">Transaction Type</label>
                            <input type="text" class="form-control" id="editTransactionType"
                                placeholder="Enter transaction type">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEditTransactionBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Edit Department Modal -->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editDepartmentForm">
                        @csrf
                        <input type="hidden" id="editDepartmentId" name="departmentId">
                        <div class="mb-3">
                            <label for="editDepartmentName" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="editDepartmentName" name="departmentName"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveEditDepartment">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div id="data-table-container">
        <div class="container mt-7">
            <table id="Departments" class="table table-sm table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="font-size: 15px;">Department</th>
                        <th style="font-size: 15px;">Transaction</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquerydataTables.bootstrap5.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="{{ asset('assets/js/sweetalert2@10.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Fetch departments and populate DataTable
            fetchDepartments();
            $('#Departments').DataTable();
        });

        // Flag to track whether an alert is being displayed
        var isAlertDisplayed = false;

        $(document).ready(function() {
            $('#saveDepartment').click(function() {
                var departmentName = $('#departmentName').val();

                $.ajax({
                    url: '{{ route('departments.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: departmentName
                    },
                    success: function(response) {
                        if (response.success) {
                            if (!isAlertDisplayed) {
                                showSuccessAlert('Department added successfully.');
                                isAlertDisplayed = true;
                            }
                            $('#addDepartmentModal').modal('hide');
                            $('#departmentName').val('');
                            // Refresh departments and DataTable after adding a department
                            fetchDepartments();
                        } else {
                            if (!isAlertDisplayed) {
                                showErrorAlert(response.message);
                                isAlertDisplayed = true;
                            }
                        }
                    },
                    error: function(xhr) {
                        if (!isAlertDisplayed) {
                            showErrorAlert('An error occurred while adding the department.');
                            isAlertDisplayed = true;
                        }
                    }
                });
            });
        });

        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                onClose: () => isAlertDisplayed = false // Reset the flag
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
                onClose: () => isAlertDisplayed = false // Reset the flag
            });
        }


        // Function to fetch and populate the departments table
        function fetchDepartments() {
            $.ajax({
                url: '{{ route('departments.all') }}',
                method: 'GET',
                success: function(response) {
                    let departmentRows = '';
                    response.departments.forEach(function(department, index) {
                        departmentRows += `
                        <tr>
                            <td>${department.name}</td>
                            <td>
                                <button class="btn btn-primary custom-button me-2 view-transaction-btn" 
                                    data-department-id="${department.id}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewTransactionsModal" 
                                    style="font-size: 13px; text-align: center;">
                                    View Transaction
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-primary custom-button me-2 edit-department-btn" 
                                    data-department-id="${department.id}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editDepartmentModal" 
                                    style="font-size: 13px; text-align: center;">
                                    <i class="fas fa-edit"></i>
                                    
                                </button>
                            </td>
                        </tr>
                    `;
                    });
                    // Populate DataTable with fetched departments
                    $('#Departments').DataTable().destroy(); // Destroy existing DataTable
                    $('#Departments tbody').html(departmentRows); // Update table body with new data
                    $('#Departments').DataTable(); // Reinitialize DataTable
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching the department list.'
                    });
                }
            });
        }

        // Function to populate department select in add transaction modal
        function populateDepartmentSelect() {
            $.ajax({
                url: '{{ route('departments.all') }}',
                method: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#departmentSelect').empty();
                    // Populate options with departments fetched from the server
                    response.departments.forEach(function(
                        department, index) {
                        $('#departmentSelect').append(
                            `<option value="${department.id}">${department.name}</option>`);
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching the department list.'
                    });
                }
            });
        }

        // Function to handle click event on "Edit" button and populate the edit modal
        $(document).on('click', '.edit-department-btn', function() {
            var departmentId = $(this).data('department-id');
            var departmentName = $(this).closest('tr').find('td:first')
                .text(); // Get the department name from the table cell

            $('#editDepartmentId').val(departmentId);
            $('#editDepartmentName').val(departmentName);
        });

        // Save edited department
        $('#saveEditDepartment').click(function() {
            var departmentId = $('#editDepartmentId').val();
            var departmentName = $('#editDepartmentName').val();

            $.ajax({
                url: '/departments/' + departmentId, // Correct URL for updating department by ID
                method: 'PUT', // Using PUT method for updating
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Add CSRF token to headers
                },
                data: {
                    name: departmentName
                },
                success: function(response) {
                    if (response.success) {
                        $('#editDepartmentModal').modal('hide');
                        fetchDepartments();
                        // Display SweetAlert alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Department updated successfully!',
                            showConfirmButton: false, // Remove the "OK" button
                            timer: 2000, // Auto close the alert after 2 seconds
                            timerProgressBar: true,
                            // didClose: function() {
                            //     location.reload(); // Reload the page
                            // }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the department.'
                    });
                }
            });
        });
    </script>
    <script>
        // Function to fetch departments and populate the select input
        function populateDepartmentSelect() {
            $.ajax({
                url: '{{ route('departments.all') }}',
                method: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#departmentSelect').empty();
                    // Populate options with departments fetched from the server
                    response.departments.forEach(function(department) {
                        $('#departmentSelect').append($('<option>', {
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

        // Call populateDepartmentSelect function to populate select input when the modal is shown
        $('#addTransactionModal').on('show.bs.modal', function() {
            populateDepartmentSelect();
        });

        // Function to delete a department
        window.deleteDepartment = function(departmentName) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('departments.destroy', '') }}/' + departmentName,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                fetchDepartments(); // Refresh the department list
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Department has been deleted.'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while deleting the department.'
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your department is safe :)',
                        'error'
                    );
                }
            });
        };

        // Function to handle transaction creation
        function createTransaction() {
            // Retrieve input values
            var transactionType = $('#transactionInput').val();
            var departmentId = $('#departmentSelect').val(); // Get the selected department ID from the dropdown menu
            // Make AJAX request
            $.ajax({
                url: '{{ route('transactions.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    department_id: departmentId,
                    transaction_type: transactionType
                },
                success: function(response) {
                    if (!isAlertDisplayed) {
                        showSuccessAlert('Transaction created successfully!');
                        isAlertDisplayed = true;
                    }
                    $('#addTransactionModal').modal('hide');
                },
                error: function(xhr) {
                    if (!isAlertDisplayed) {
                        showErrorAlert('Failed to create transaction. Error: ' + xhr.responseText);
                        isAlertDisplayed = true;
                    }
                }
            });
        }

        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                onClose: () => isAlertDisplayed = false // Reset the flag
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
                onClose: () => isAlertDisplayed = false // Reset the flag
            });
        }

        // Submit form using AJAX when 'Save Transaction' button is clicked
        $('#saveTransactionBtn').click(function() {
            createTransaction();
        });

        // Event listener for "View Transaction" button click
        $(document).on('click', '.view-transaction-btn', function() {
            let departmentId = $(this).data('department-id');
            fetchTransactionsByDepartment(departmentId);
        });

        // Function to fetch transactions for a specific department and populate the modal body
        function fetchTransactionsByDepartment(departmentId) {
            $.ajax({
                url: `/transactions/by-department/${departmentId}`,
                method: 'GET',
                success: function(response) {
                    let transactionRows = '';
                    response.transactions.forEach(function(transaction, index) {
                        transactionRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${transaction.transaction_type}</td>
                        <td>
                            <button class="btn btn-secondary edit-transaction-btn" data-transaction-id="${transaction.id}">
                                <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                            </button>
                        </td>
                    </tr>
                `;
                    });
                    $('#transactionsBody').html(
                        transactionRows); // Populate the modal body with transaction types
                },
                error: function(xhr) {
                    $('#transactionsBody').html('<tr><td colspan="2">No Available Transaction Type.</td></tr>');
                }
            });
        }

        // Function to handle click event on "Edit" button and populate the edit modal
        $(document).on('click', '.edit-transaction-btn', function() {
            // Here, you can implement the logic to populate the edit modal based on the transaction id
            var transactionId = $(this).data('transaction-id');
            // For demonstration purposes, let's just log the transaction id to console
            console.log('Edit Transaction Id:', transactionId);
            // Show the edit transaction modal
            $('#editTransactionModal').modal('show');
        });

        // Event listener for closing the edit transaction modal using close button in the modal body
        $('#editTransactionModal .modal-footer .btn-secondary').click(function() {
            $('#editTransactionModal').modal('hide');
        });

        // Event listener for closing the edit transaction modal using the close icon button in the modal header
        $('#editTransactionModal .modal-header .close').click(function() {
            $('#editTransactionModal').modal('hide');
        });
        // Flag to track whether an alert is being displayed
        var isAlertDisplayed = false;

        // Function to update a transaction
        function updateTransaction(transactionId, transactionType) {
            $.ajax({
                url: `/transactions/${transactionId}`, // URL for updating transaction by ID
                method: 'PUT', // Using POST method for updating
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token to headers
                },
                data: {
                    transaction_type: transactionType
                },
                success: function(response) {
                    if (response.success) {
                        if (!isAlertDisplayed) {
                            showSuccessAlert();
                            isAlertDisplayed = true;
                        }
                    } else {
                        if (!isAlertDisplayed) {
                            showErrorAlert(response.message);
                            isAlertDisplayed = true;
                        }
                    }
                },
                error: function(xhr) {
                    if (!isAlertDisplayed) {
                        showErrorAlert('An error occurred while updating the transaction.');
                        isAlertDisplayed = true;
                    }
                }
            });
        }

        function showSuccessAlert() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Transaction updated successfully!',
                showConfirmButton: false, // Remove the "OK" button
                timer: 2000, // Auto close the alert after 2 seconds
                timerProgressBar: true,
                didClose: function() {
                    // location.reload(); // Reload the page
                    isAlertDisplayed = false; // Reset the flag
                }
            });
        }

        function showErrorAlert(errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage,
                onClose: () => isAlertDisplayed = false // Reset the flag
            });
        }



        // Event listener for "Save Changes" button click in the edit transaction modal
        $('#saveEditTransactionBtn').click(function() {
            var transactionId = $('#editTransactionType').data('transaction-id');
            var transactionType = $('#editTransactionType').val();
            updateTransaction(transactionId, transactionType);
        });

        // Function to fetch transaction details by ID and populate the edit modal
        function fetchTransactionDetails(transactionId) {
            $.ajax({
                url: `/transactions/${transactionId}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Populate the edit form with transaction data
                        $('#editTransactionType').val(response.transaction.transaction_type);
                        // Set data attribute for transaction ID
                        $('#editTransactionType').data('transaction-id', response.transaction.id);
                        // Show the edit transaction modal
                        $('#editTransactionModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching the transaction details.'
                    });
                }
            });
        }

        // Event listener for the "Edit" button click
        $(document).on('click', '.edit-transaction-btn', function() {
            var transactionId = $(this).data('transaction-id');
            fetchTransactionDetails(transactionId);
        });

        // Event listener for "Save Changes" button click in the edit transaction modal
        $('#saveEditTransactionBtn').click(function() {
            var transactionId = $('#editTransactionType').data('transaction-id');
            var transactionType = $('#editTransactionType').val();
            updateTransaction(transactionId, transactionType);
        });

        // Event listener for closing the edit transaction modal using the close button in the modal body
        $('#editTransactionModal .modal-footer .btn-secondary').click(function() {
            $('#editTransactionModal').modal('hide');
        });

        // Event listener for closing the edit transaction modal using the close icon button in the modal header
        $('#editTransactionModal .modal-header .close').click(function() {
            $('#editTransactionModal').modal('hide');
        });
    </script>




</body>

</html>
