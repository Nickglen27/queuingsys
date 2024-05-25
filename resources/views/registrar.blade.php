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
    <link href="https://fonts.googleapis.com/css2?family=Oregon&display=swap" rel="stylesheet">

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
    gap: 5px; /* Adjust the gap between buttons as needed */
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
            gap: 5px; /* Adjust the gap between buttons as needed */
        }

    </style>
</head>

<body style="background-color: #ffffff;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5e0b0e;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>REGISTRAR</h1>
            </a>
            <strong>
                <div class="timezone"><span id="beijing-time"></span></div>
            </strong>
        </div>
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
        <table id="studentTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 30%;">Name</th>
                <th style="width: 30%;">Transaction</th>
                <th style="width: 25%;">Department</th>
                <th style="width: 25%;">Window</th>
    
                <th style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
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
                    <table class="table table-striped table-bordered">
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
                    </table>
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
    // Make an AJAX request to fetch the student transactions
    $.ajax({
        url: '/fetch-stud-trans', // Adjust the URL as per your routing configuration
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Check the console for the response structure
            console.log(data);

            // Initialize the DataTable with fetched data
            var dataTable = $('#studentTable').DataTable({
                data: data,
                columns: [
                    { data: null, className: 'text-center', render: (data, type, row, meta) => meta.row + 1 },
                    { data: null, className: 'text-center', render: data => `${data.student.Firstname} ${data.student.Middlename} ${data.student.Lastname}` },
                    { data: 'transaction.transaction_type', className: 'text-center', defaultContent: 'N/A' },
                    { data: 'department.name', className: 'text-center' },
                    { data: 'windows', className: 'text-center' }, // Corrected field name to 'windows'
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <div class="action-buttons">
                                    <button class="btn btn-primary call" data-id="${row.id}">Call</button>
                                    <button class="btn btn-secondary archive" data-id="${row.id}">Archive</button>
                                    <button class="btn btn-success done" data-id="${row.id}">Done</button>
                                </div>`;
                        }
                    }
                ]
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching student transactions:', error);
        }
    });
});


































































// $(document).ready(function() {
//     function populateTable() {
//         $.ajax({
//             url: '/fetch-studtrans',
//             method: 'GET',
//             dataType: 'json',
//             success: function(response) {
//                 var tbody = $('#dataTable tbody');
//                 tbody.empty();

//                 response.forEach(function(item, index) {
//                     var row = $('<tr>');

//                     row.append($('<td>').text(index + 1));
//                     row.append($('<td>').text(item.student.Firstname + ' ' + item.student.Middlename + ' ' + item.student.Lastname));
//                     row.append($('<td>').text(item.transaction.transaction_type));
//                     row.append($('<td>').text(item.department.name));
//                     row.append($('<td>').text('Window')); // Replace with actual window data if available

//                     // Create buttons container
//                     var buttonsContainer = $('<div class="btn-group" role="group">');
//                     var callButton = $('<button class="btn btn-yellow">').text('Call');
//                     var archiveButton = $('<button class="btn btn-blue">').text('Archive');
//                     var doneButton = $('<button class="btn btn-success">').text('Done');

//                     // Append buttons to the buttons container
//                     buttonsContainer.append(callButton).append(archiveButton).append(doneButton);

//                     // Create a table cell and append the buttons container
//                     var buttonsCell = $('<td>').append(buttonsContainer);
//                     row.append(buttonsCell);

//                     tbody.append(row);
//                 });
//             },
//             error: function(xhr, status, error) {
//                 console.error("Failed to fetch studtrans:", status, error);
//             }
//         });
//     }

//     populateTable();
// });







    











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
    
            // Initialize DataTable
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });














    </script>

</body>

</html>