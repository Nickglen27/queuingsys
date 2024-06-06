<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User</title>

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

    <!-- Custom Styles -->
    <style>
        body {
            min-height: 100vh;
            background-color: var(--body-color);
            transition: var(--tran-05);
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#"
                style="font-family: Arial, sans-serif; font-size: 42px;"><strong>User</strong></a>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="archive-container">
                    <button class="btn btn-success archive-btn" data-bs-toggle="modal" data-bs-target="#archiveModal">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add User
                </button>
            </div>
        </div>



        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sidebar modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #0d6efd;">
                        <h5 class="modal-title" id="addUserModalLabel" style="color: white;">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm">
                            @csrf <!-- Add CSRF token -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type</label>
                                <input type="text" class="form-control" id="user_type" name="user_type"
                                    placeholder="Enter user type">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="department">
                                    <option selected>Select department...</option>
                                    <!-- Options will be populated here by JavaScript -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="window" class="form-label">Window</label>
                                <select class="form-select" id="window" name="window">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <!-- Add more fields as needed -->
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="addUserForm" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #0d6efd;">
                        <h5 class="modal-title" id="editUserModalLabel" style="color: white;">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            @csrf <!-- Add CSRF token -->
                            <input type="hidden" id="editUserId" name="id">
                            <!-- Hidden input field for user ID -->
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="name"
                                    placeholder="Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="editPassword" name="password"
                                    placeholder="Enter password">
                            </div>
                            <div class="mb-3">
                                <label for="editUserType" class="form-label">User Type</label>
                                <input type="text" class="form-control" id="editUserType" name="user_type"
                                    placeholder="Enter user type">
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select class="form-select" id="editStatus" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editDepartment" class="form-label">Department</label>
                                <select class="form-select" id="editDepartment" name="department_id">
                                    <option selected>Select department...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editWindow" class="form-label">Window</label>
                                <select class="form-select" id="editWindow" name="window">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editUserForm" class="btn btn-primary edit-user-btn">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <table id="user_dataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width: 35%; font-size: 15px;">Username</th>
                        <th style="width: 35%; font-size: 15px;">Email</th>
                        <th style="width: 15%; font-size: 15px;">Status</th>
                        <th style="width: 35%; font-size: 15px;">Department</th>
                        <th style="width: 10%; font-size: 15px;">Window</th>
                        <th style="width: 5%; font-size: 15px;">Action</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        {{-- <table id="TransactionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Transaction Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by DataTables -->
            </tbody>
        </table> --}}
        <!-- Include necessary scripts -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Your custom JavaScript -->
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#user_dataTable').DataTable({
                    paging: true,
                    searching: true
                });

                // Function to fetch user data and populate the table
                function fetchUsers() {
                    $.ajax({
                        url: '/registered-user',
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log('User data retrieved successfully:', response);
                            displayUsers(response.data);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error fetching user data:', textStatus, errorThrown);
                        }
                    });
                }

                // Function to display users in the DataTable
                function displayUsers(users) {
                    var table = $('#user_dataTable').DataTable();
                    table.clear().destroy(); // Destroy existing DataTable and clear its data
                    $('#user_dataTable').DataTable({
                        data: users,
                        columns: [{
                                data: 'name',
                                title: 'Username'
                            },
                            {
                                data: 'email',
                                title: 'Email'
                            },
                            {
                                data: 'status',
                                title: 'Status',
                                render: function(data) {
                                    return data === 1 ? '<span class="badge bg-success">Active</span>' :
                                        '<span class="badge bg-danger">Inactive</span>';
                                }
                            },
                            {
                                data: 'department_id',
                                title: 'Department'
                            },
                            {
                                data: 'window',
                                title: 'Window'
                            },
                            {
                                data: null,
                                title: 'Action',
                                render: function(data, type, row) {
                                    return '<button class="btn btn-sm btn-primary edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="' +
                                        row.id + '"><i class="fas fa-edit"></i> Edit</button>'; +
                                    '<button class="btn btn-sm btn-danger delete-user" data-id="' + data
                                        .id + '"><i class="fas fa-trash"></i></button>';
                                }
                            }
                        ]
                    });
                }

                // Call fetchUsers function when the page loads
                fetchUsers();

                // Fetch departments for modals
                function fetchDepartments(selectElement) {
                    $.ajax({
                        url: '{{ route('departments.all') }}',
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var departments = response.departments;
                            selectElement.empty();
                            selectElement.append('<option selected>Select department...</option>');
                            $.each(departments, function(index, department) {
                                selectElement.append('<option value="' + department.id + '">' +
                                    department.name + '</option>');
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching departments:', error);
                        }
                    });
                }

                // Fetch departments when the Add User modal is shown
                $('#addUserModal').on('shown.bs.modal', function() {
                    fetchDepartments($('#department'));
                });

                // Add user form submission
                $('#addUserForm').submit(function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    var formData = {
                        name: $('#username').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        department_id: $('#department').val(),
                        user_type: $('#user_type').val(),
                        window: $('#window').val()
                    };

                    // Submit the form data using AJAX
                    $.ajax({
                        url: '/register',
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('User added successfully:', response);
                            $('#addUserModal').modal('hide');
                            fetchUsers(); // Refresh the user table
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error adding user:', textStatus, errorThrown);
                            if (xhr.status === 422) {
                                console.error('Validation errors:', xhr.responseJSON);
                            } else if (xhr.status === 404) {
                                console.error('API endpoint not found.');
                            } else if (xhr.status === 500) {
                                console.error('Server error.');
                            } else {
                                console.error('Unexpected error:', xhr.status);
                            }
                        }
                    });
                });

                // Fetch departments when the Edit User modal is shown
                $('#editUserModal').on('shown.bs.modal', function() {
                    fetchDepartments($('#editDepartment'));
                });

            });
        </script>
        <script>
            $(document).ready(function() {
                // Function to update user details
                function updateUserDetails(userId, formData) {
                    console.log('Updating user with ID:', userId);
                    console.log('Form data:', formData);

                    $.ajax({
                        type: 'POST',
                        url: '/users/' + userId,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Add CSRF token header
                        },
                        success: function(response) {
                            console.log('User data updated successfully:', response);
                            $('#editUserModal').modal('hide'); // Hide the modal
                            // Display SweetAlert alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User data updated successfully!',
                                showConfirmButton: false, // Remove the "OK" button
                                timer: 2000, // Auto close the alert after 2 seconds
                                timerProgressBar: true,
                                didClose: function() {
                                    location.reload(); // Reload the page
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating user data:', error);
                            // Log the error response from the server
                            console.error('Error response:', xhr.responseText);
                            // You can display an error message to the user or handle the error in any other way
                        }
                    });
                }

                // Event listener for when the edit user modal is shown
                $('#editUserModal').on('shown.bs.modal', function(e) {
                    // Get the ID of the selected user from the modal's data-id attribute
                    var userId = $(e.relatedTarget).data('id');

                    // Log the selected user ID
                    console.log('User ID requested:', userId);

                    // Check if userId is defined
                    if (userId === undefined) {
                        console.error('User ID is undefined');
                        return; // Exit the function if userId is undefined
                    }

                    // Fetch user details
                    $.ajax({
                        type: 'GET',
                        url: '/users/' + userId,
                        success: function(response) {
                            // Check if the response object has the expected properties
                            if (response && typeof response === 'object' && 'id' in response &&
                                'name' in response && 'email' in response && 'status' in response &&
                                'department_id' in response && 'window' in response) {
                                // Populate the modal fields with the retrieved user details
                                $('#editUserId').val(response.id);
                                $('#editUsername').val(response.name);
                                $('#editEmail').val(response.email);
                                $('#editPassword').val(''); // Clear password field
                                $('#editUserType').val(response.status);
                                $('#editStatus').val(response.status);
                                $('#editDepartment').val(response.department_id);
                                $('#editWindow').val(response.window);
                            } else {
                                console.error('Invalid response format:', response);
                                // Display an error message or handle the error in any other way
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error('Error fetching user details:', error);
                            // You can display an error message to the user or handle the error in any other way
                        }
                    });
                });

                // Event listener for form submission to update user data
                $('#editUserForm').submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission
                    var userId = $('#editUserId').val(); // Get user ID
                    var formData = $(this).serialize(); // Serialize form data

                    console.log('Form submitted for user ID:', userId);
                    console.log('Form data:', formData);

                    // Update user details
                    updateUserDetails(userId, formData);
                });
            });
        </script>

</body>

</html>
