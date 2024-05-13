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
            <a class="navbar-brand" href="#"><strong>Hello Admin</strong></a> <!-- Bold "Hello Admin" -->
        </div>
    </nav>

    <div class="container mt-3">
        <button class="btn btn-primary custom-button">Add Department</button>
    </div>

    <br><br><br>
    <!-- DataTable -->
    <div class="container mt-3">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><strong>Department</strong></th> <!-- Bold "Department" -->
                    <th><strong>Transaction</strong></th> <!-- Bold "Transaction" -->
                    <th><strong>Window</strong></th> <!-- Bold "Window" -->
                    <th><strong>Action</strong></th> <!-- Bold "Action" -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cashier</td>
                    <td>Deposit</td>
                    <td>3</td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button> <!-- Edit icon -->
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> <!-- Delete icon -->
                    </td>
                </tr>
                <tr>
                    <td>Admin</td>
                    <td>Deposit</td>
                    <td>1</td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button> <!-- Edit icon -->
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> <!-- Delete icon -->
                    </td>
                </tr>
                <tr>
                    <td>Cashier</td>
                    <td>Tuition</td>
                    <td>3</td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button> <!-- Edit icon -->
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> <!-- Delete icon -->
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>
