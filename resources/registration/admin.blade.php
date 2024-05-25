<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>adminside</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <style>
        /* Custom CSS to adjust nav height */
        .navbar {
            height: 100px;
            /* Adjust the height as needed */
        }

        /* Animation */
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
            /* Apply Poppins font */
            animation: bounce 2s infinite;
            font-size: 28px;
            /* Adjust the font size as needed */
            font-weight: bold;
            /* Make it bold */
        }

        /* Custom CSS for the button */
        .custom-button {
            float: right;
            margin-top: 10px;
        }

        #example th {
            color: #01070f;
            text-align: center;
            /* Center align text */
        }

        /* Center align text in table */
        #example td {
            text-align: center;
        }

        /* Bold the <thead> elements */
        thead th {
            font-weight: bold;
        }
    </style>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="background-color: #ECF0F1;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Hello Admin</strong></a>
            <!-- Bold "Hello Admin" -->
            <button class="btn btn-outline-light" onclick="window.location='{{ route('logout') }}'" title="Logout">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </button>
            <!-- Button with logout icon and text -->
        </div>
    </nav>


    <div class="container mt-3">
        <button class="btn btn-primary custom-button me-2" data-bs-toggle="modal"
            data-bs-target="#addDepartmentModal">Add
            Department</button>
    </div>


    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding department -->
                    <form id="addDepartmentForm" action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="nameInput" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Detail Modal -->
    <div class="modal fade" id="departmentDetailModal" tabindex="-1" aria-labelledby="departmentDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="departmentDetailModalLabel">Department Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" id="addTransactionBtn">Add
                            Transaction</button>
                    </div>
                    <div class="mb-3">
                        <label for="departmentNameInput" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="departmentNameInput" readonly
                            style="width: 20%;">
                    </div>

                    <table id="transactionTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Transaction data will be dynamically inserted here -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="transactionName" class="form-label">Transaction Type</label>
                        <input type="text" class="form-control" id="transactionName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveTransactionBtn">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>


    <br><br><br>
    <!-- DataTable -->
    <div class="container mt-3">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><strong>Department</strong></th> <!-- Bold "Department" -->
                    <th><strong>Action</strong></th> <!-- Bold "Action" -->
                </tr>
            </thead>
            <tbody id="dataTableBody"> <!-- Add an ID to the tbody for dynamic data insertion -->
                <!-- Existing table body content goes here -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();
            var storedData = localStorage.getItem('dataTableData');
            if (storedData) {
                var parsedData = JSON.parse(storedData);
                parsedData.forEach(function(item) {
                    table.row.add(item).draw(false);
                });
            }
            $('#addDepartmentForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        table.row.add([
                            '<a href="#" class="department-link" data-bs-toggle="modal" data-bs-target="#departmentDetailModal">' +
                            response.name + '</a>',
                            '<button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>' +
                            '<button class="btn btn-sm btn-danger deleteBtn"><i class="fas fa-trash"></i></button>'
                        ]).draw(false);

                        $('#addDepartmentForm')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Successfully Added',
                            confirmButtonText: 'OK'
                        });
                        saveDataTableData();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            });

            $('#example').on('click', '.deleteBtn', function() {
                var row = $(this).closest('tr');
                var rowData = table.row(row).data();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/departments/' + rowData[0],
                            success: function(response) {
                                table.row(row).remove().draw(false);
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                );
                                saveDataTableData();
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.error('Error:', textStatus, errorThrown);
                                table.row(row).remove().draw(false);
                                saveDataTableData();
                            }
                        });
                    }
                });
            });

            // Function to save DataTable data to localStorage
            function saveDataTableData() {
                var data = table.rows().data().toArray();
                localStorage.setItem('dataTableData', JSON.stringify(data));
            }

            // Open modal when department link is clicked
            $('#example').on('click', '.department-link', function(e) {
                e.preventDefault(); // Prevent default link behavior
                var departmentName = $(this).text();
                $('#departmentNameInput').val(departmentName); // Set department name
                $('#departmentDetailModal').modal('show');
            });
            // Add transaction modal script
            $('#addTransactionBtn').click(function() {
                $('#addTransactionModal').modal('show');
            });
        });
    </script>
</body>

</html>
