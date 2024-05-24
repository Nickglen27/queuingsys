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

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


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

        body.dark {
            --body-color: #18191a;
            --sidebar-color: #242526;
            --primary-color: #3a3b3c;
            --primary-color-light: #3a3b3c;
            --toggle-color: #fff;
            --text-color: #ccc;
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

        .custom-button {
            float: right;
            margin-top: 10px;
        }

        /* Custom Data Table Styling */
        #example th,
        #example td {
            text-align: center;
        }

        thead th {
            font-weight: bold;
        }

        /* Shadow Effect */
        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Custom CSS for smaller text in modals */
        .modal-content .modal-header,
        .modal-content .modal-body,
        .modal-content .modal-footer,
        .modal-content .modal-title,
        .modal-content .form-label,
        .modal-content .form-control,
        .modal-content .btn {
            font-size: 0.875rem;
            /* This is equivalent to small text */
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            padding: 5px 5px;
            background: var(--sidebar-color);
            transition: var(--tran-05);
            z-index: 100;
        }

        .sidebar.close {
            width: 68px;
        }

        .sidebar li {
            height: 50px;
            list-style: none;
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .sidebar header .image,
        .sidebar .icon {
            min-width: 60px;
            border-radius: 6px;
        }

        .sidebar .icon {
            min-width: 1px;
            border-radius: 6px;
            height: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .sidebar .text,
        .sidebar .icon {
            color: var(--text-color);
            transition: var(--tran-03);
        }

        .sidebar.close .text {
            opacity: 0;
        }

        .sidebar header {
            position: relative;
        }

        .sidebar header .toggle {
            position: absolute;
            top: 50%;
            right: -15px;
            transform: translateY(-0%) rotate(180deg);
            height: 35px;
            width: 35px;
            background-color: var(--primary-color);
            color: var(--sidebar-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            transition: var(--tran-05);
        }

        body.dark .sidebar header .toggle {
            color: var(--text-color);
        }

        .sidebar.close .toggle {
            transform: translateY(-50%) rotate(0deg);
        }

        .sidebar .menu {
            margin-top: 40px;
        }

        .sidebar li a {
            list-style: none;
            height: 100%;
            background-color: transparent;
            display: flex;
            align-items: center;
            height: 100%;
            width: 100%;
            border-radius: 6px;
            text-decoration: none;
            transition: var(--tran-03);
        }

        .sidebar li a:hover {
            background-color: var(--primary-color);
        }

        .sidebar li a:hover .icon,
        .sidebar li a:hover .text {
            color: var(--sidebar-color);
        }

        body.dark .sidebar li a:hover .icon,
        body.dark .sidebar li a:hover .text {
            color: var(--text-color);
        }

        .sidebar .menu-bar {
            height: calc(100% - 55px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }

        .menu-bar::-webkit-scrollbar {
            display: none;
        }

        .sidebar .menu-bar .mode {
            border-radius: 6px;
            background-color: var(--primary-color-light);
            position: relative;
            transition: var(--tran-05);
        }

        .menu-bar .mode .sun-moon {
            height: 50px;
            width: 60px;
        }

        .mode .sun-moon i {
            position: absolute;
        }

        .mode .sun-moon i.sun {
            opacity: 0;
        }

        body.dark .mode .sun-moon i.sun {
            opacity: 1;
        }

        body.dark .mode .sun-moon i.moon {
            opacity: 0;
        }

        .menu-bar .bottom-content .toggle-switch {
            position: absolute;
            right: 0;
            height: 100%;
            min-width: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            cursor: pointer;
        }

        .toggle-switch .switch {
            position: relative;
            height: 22px;
            width: 40px;
            border-radius: 25px;
            background-color: var(--toggle-color);
            transition: var(--tran-05);
        }

        .switch::before {
            content: '';
            position: absolute;
            height: 15px;
            width: 15px;
            border-radius: 50%;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            background-color: var(--sidebar-color);
            transition: var(--tran-04);
        }

        body.dark .switch::before {
            left: 20px;
        }

        .sidebar.close~.home {
            left: 78px;
            height: 100vh;
            width: calc(100% - 78px);
        }

        body.dark .home .text {
            color: var(--text-color);
        }

        /* Main content and data table adjustments */
        #main-content,
        #data-table-container {
            transition: margin-left 0.3s ease;
            margin-left: 250px;
            /* Initial margin for open sidebar */
        }

        body.sidebar-close #main-content,
        body.sidebar-close #data-table-container {
            margin-left: 70px;
        }
    </style>
</head>

<body style="background-color: #ECF0F1;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" id="navbar">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand text-center" href="#"><strong>Hello Admin</strong></a>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="sidebar close">
        <header>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-building-house icon'></i>
                            <span class="text nav-text">Department</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">User</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <div id="main-content" class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-primary custom-width me-3" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class="fas fa-user fa-sm me-3"></i>User Role
            </button>
            <div class="d-flex">
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
                            <strong><label for="transactionInput" class="form-label">Transaction Type:</label></strong>
                            <input type="text" class="form-control" id="transactionInput"
                                placeholder="Enter Transaction Type" required>
                        </div>
                        <div class="mb-3">
                            <strong><label for="departmentSelect" class="form-label">Select Department:</label></strong>
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

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-center">
                    <h5 class="modal-title text-white fw-bold fs-2" id="userModalLabel">User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="usersTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Department</th>
                                <th>Window</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-username="John Doe" data-department="Cashier" data-window="Windows 10">
                                <td>John Doe</td>
                                <td>Cashier</td>
                                <td>Windows 10</td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1 edit-btn" title="Edit"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr data-username="Jane Smith" data-department="Registrar" data-window="Windows 11">
                                <td>Jane Smith</td>
                                <td>Registrar</td>
                                <td>Windows 11</td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1 edit-btn" title="Edit"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="data-table-container">
        <div class="container mt-7">
            <table id="Departments" class="table table-sm table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Transaction</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog shadow">
            <div class="modal-content">
                <div class="modal-header bg-success text-center">
                    <h5 class="modal-title text-white fw-bold fs-2" id="editUserModalLabel">Edit User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="mb-3">
                            <strong><label for="editUsername" class="form-label">Username</label></strong>
                            <input type="text" class="form-control" id="editUsername" required>
                        </div>
                        <div class="mb-3">
                            <strong><label for="editDepartment" class="form-label">Department</label></strong>
                            <select class="form-control" id="editDepartment" required>
                                <option value="Cashier">Cashier</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Support">Support</option>
                                <!-- Add more departments as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <strong><label for="editWindow" class="form-label">Window</label></strong>
                            <input type="text" class="form-control" id="editWindow" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
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


    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav.sidebar'),
            toggle = body.querySelector(".toggle"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text"),
            mainContent = body.querySelector("#main-content"),
            dataTableContainer = body.querySelector("#data-table-container");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if (sidebar.classList.contains("close")) {
                body.classList.remove('sidebar-open');
                body.classList.add('sidebar-close');
                mainContent.style.marginLeft = "70px";
                dataTableContainer.style.marginLeft = "70px";
            } else {
                body.classList.remove('sidebar-close');
                body.classList.add('sidebar-open');
                mainContent.style.marginLeft = "250px";
                dataTableContainer.style.marginLeft = "250px";
            }
        });

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });

        // Set initial state
        if (sidebar.classList.contains("close")) {
            body.classList.add('sidebar-close');
            mainContent.style.marginLeft = "70px";
            dataTableContainer.style.marginLeft = "70px";
        } else {
            body.classList.add('sidebar-open');
            mainContent.style.marginLeft = "250px";
            dataTableContainer.style.marginLeft = "250px";
        }


        $(document).ready(function() {
    $('#Departments, #usersTable').DataTable();
});

$(document).ready(function() {
        // Fetch departments and populate DataTable
        fetchDepartments();
    });

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
                        $('#addDepartmentModal').modal('hide');
                        $('#departmentName').val('');
                        // Refresh departments and DataTable after adding a department
                        fetchDepartments();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Department added successfully.'
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
                        text: 'An error occurred while adding the department.'
                    });
                }
            });
        });
    });

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
                            <td><button class="btn btn-primary custom-button me-2 view-transaction-btn" data-department-id="${department.id}" data-bs-toggle="modal" data-bs-target="#viewTransactionsModal" style="float: left;">View Transaction</button></td>
                            <td><button class="btn btn-danger btn-sm" onclick="deleteDepartment('${department.name}')"><i class="fas fa-trash-alt"></i></button></td>
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

// Fetch departments when the "Get All Departments" button is clicked
$('#getDepartmentsBtn').click(function() {
    fetchDepartments();
});

// Function to handle transaction creation
function createTransaction() {
    // Retrieve input values
    var transactionType = $('#transactionInput').val();
    var departmentId = $('#departmentSelect').val();

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
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Transaction created successfully!'
            });
            // Optionally, you can perform additional actions here, such as updating UI or closing the modal
            $('#addTransactionModal').modal('hide');
        },
        error: function(xhr) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to create transaction. Error: ' + xhr.responseText
            });
        }
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
                        <!-- Add more columns as needed -->
                    </tr>
                `;
            });
            $('#transactionsBody').html(transactionRows); // Populate the modal body with transaction types
        },
        error: function(xhr) {
            $('#transactionsBody').html('<tr><td colspan="2">No Available Transaction Type.</td></tr>');
        }
    });
}

document.addEventListener('DOMContentLoaded', (event) => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    const editUserForm = document.getElementById('editUserForm');
    let currentRow;

    editButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const row = e.target.closest('tr');
            currentRow = row;
            const username = row.getAttribute('data-username');
            const department = row.getAttribute('data-department');
            const window = row.getAttribute('data-window');

            document.getElementById('editUsername').value = username;
            document.getElementById('editDepartment').value = department;
            document.getElementById('editWindow').value = window;

            editUserModal.show();
        });
    });

    editUserForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const updatedUsername = document.getElementById('editUsername').value;
        const updatedDepartment = document.getElementById('editDepartment').value;
        const updatedWindow = document.getElementById('editWindow').value;

        currentRow.querySelector('td:nth-child(1)').textContent = updatedUsername;
        currentRow.querySelector('td:nth-child(2)').textContent = updatedDepartment;
        currentRow.querySelector('td:nth-child(3)').textContent = updatedWindow;

        currentRow.setAttribute('data-username', updatedUsername);
        currentRow.setAttribute('data-department', updatedDepartment);
        currentRow.setAttribute('data-window', updatedWindow);

        editUserModal.hide();
    });
});


    </script>

</body>

</html>