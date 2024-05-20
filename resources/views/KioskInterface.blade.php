<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anak ni Milo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/ck.jpg') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/ck.jpg') }}" type="image/jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Existing CSS */
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(32,154,85,1) 31%, rgba(0,212,255,1) 100%);
        }

        h2 {
            font-size: 30px;
            color: black;
        }

        .logo {
            font-weight: bold;
            text-align: center;
            font-size: 40px;
            color: #4fd4c9;
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            width: 100%;
            padding: 20px;
        }

        .form-container1 {
            width: 50%;
            padding: 20px;
            border: 3px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            height: 700px;
            background: white;
        }

        .form-text-container {
            width: 100%;
            padding: 10px;
            border: 6px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            height: 370px;
        }

        .form-button-container {
            width: 100%;
            padding: 10px;
            border: 6px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            height: 440px;
        }

        .form-container {
            width: 45%;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            height: 600px;
            background: white;
            overflow-y: auto; /* Enable vertical scrollbar if content exceeds container height */
        }

        .vertical-separator {
            width: 2px;
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(32,154,85,1) 31%, rgba(0,212,255,1) 100%);
            margin-top: 20px;
            align-self: stretch;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-size: 18px;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 50px;
            border: 3px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]::placeholder {
            color: #999;
        }

        input[type="text"]:hover,
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            display: block;
            width: 100%;
            padding: 15px 8px;
            border: 7px solid #ccc;
            border-radius: 2px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        .col-md-4 {
            padding: 0 15px;
        }

        .form-button-container .row > div {
            margin-bottom: 15px;
        }

        #formTextContainer p {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #departmentList {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 400px; /* Limit the maximum height of the department list */
            overflow-y: auto; /* Enable vertical scrollbar if content exceeds the max height */
        }

        #departmentList::-webkit-scrollbar {
            width: 0; /* Remove scrollbar width */
            height: 0; /* Remove scrollbar height */
        }

        #departmentList button {
            display: block;
            width: 100%;
            padding: 15px 8px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        #departmentList button:hover {
            background-color: #0056b3;
        }

        #departmentList button:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        .modal-footer {
            justify-content: flex-end; /* Align buttons to the end of the footer */
        }

        /* Style for the Close button */
        .btn-close {
            width: 10px; /* Set a specific width for the button */
            padding: 5px 10px; /* Add padding to the button for spacing */
            font-size: 14px; /* Adjust the font size of the button */
        }

        /* New CSS for Cover Photo */
             .cover-photo-container {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .cover-photo-container img {
             width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Existing HTML content -->
    <div class="form-container1">
        <h2>
            <div class="logo">
                Laguindingan National Highschool
            </div>
        </h2>
        <form>
            <strong><label for="name1">Enter Name:</label></strong>
            <input type="text" id="name1" name="name1" placeholder="Enter your name">
            <br>
            <div class="form-text-container" id="formTextContainer"></div>  
        </form>
    </div>

    <div class="vertical-separator"></div>

    <div class="form-container">
        <div style="display: flex; justify-content: center;">
            <h2 style="font-weight: bold;">Select Department</h2>
        </div>

        <form>
            <div class="form-button-container">
                <div class="row">
                    <ul id="departmentList"></ul>
                </div>
            </div>
            <button type="button" id="doneButton" class="btn btn-success btn-lg btn-block">Proceed</button>
        </form>
    </div>

    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departmentModalLabel">Department Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="transactionsBody">Select Transaction</p>
                <select id="transactionsBodyselect" class="form-control"></select>
            </div>
            <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Save</button>
</div>

        </div>
    </div>
</div>

<!-- Cover Photo HTML -->
<div class="cover-photo-container" id="coverPhotoContainer">
    <img src="{{ asset('images/background.jpg') }}" alt="Cover Photo">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
    // Initialize variables to store selected department and transaction details
    var selectedDepartment = '';
    var selectedTransaction = '';
    var selectedName = '';
    var selectedGrade = '';
    var selectedSection = '';
    var selectedStudentId = ''; // Assuming you have this information
    var selectedDepartmentId = ''; // Assuming you have this information
    var selectedTransactionId = ''; // Assuming you have this information


    function fetchDepartments() {
        $.ajax({
            type: "GET",
            url: "/fetch-departments",
            dataType: "json",
            success: function(response) {
                var departmentList = $('#departmentList');
                departmentList.empty();

                if (response.departments && response.departments.length > 0) {
                    response.departments.forEach(function(department) {
                        var departmentButton = $('<button type="button" class="btn btn-outline-primary btn-lg">' + department.name + '</button>');

                        departmentButton.click(function() {
                            selectedDepartment = department.name; // Update selected department
                            $('#departmentModalLabel').text(department.name);
                            $('#departmentDetails').text('Details for ' + department.name);

                            // Fetch transactions for this department
                            fetchTransactions(department.id);

                            $('#departmentModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            }).modal('show');
                        });

                        departmentList.append($('<li>').append(departmentButton));
                    });
                } else {
                    departmentList.append('<li>No departments found</li>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch departments:", status, error);
                $('#departmentList').append('<li class="text-danger">Error fetching departments. Please try again later.</li>');
            }
        });
    }

    function fetchTransactions(departmentId) {
        $.ajax({
            url: '/transactions/by-department/' + departmentId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var selectElement = $('#transactionsBodyselect');
                selectElement.empty();

                if (response.transactions && response.transactions.length > 0) {
                    response.transactions.forEach(function(transaction) {
                        selectElement.append($('<option>', {
                            value: transaction.id,
                            text: transaction.transaction_type
                        }));
                    });
                } else {
                    selectElement.append($('<option>', {
                        value: '',
                        text: 'No transactions found'
                    }));
                }
                // Update selectedTransaction when the transaction selection changes
                selectedTransaction = selectElement.find('option:selected').text();
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch transactions:", status, error);
                var selectElement = $('#transactionsBodyselect');
                selectElement.empty();
                selectElement.append($('<option>', {
                    value: '',
                    text: 'Error fetching transactions. Please try again later.'
                }));
            }
        });
    }

    fetchDepartments();

    $('#doneButton').click(function() {
    // Display Swal.fire modal with selected details
    Swal.fire({
        title: 'Selected Details',
        html: 'Name: ' + selectedName + '<br>' +
              'Grade: ' + selectedGrade + '<br>' +
              'Section: ' + selectedSection + '<br>' +
              'Department: ' + selectedDepartment + '<br>' +
              'Transaction: ' + selectedTransaction,
        icon: 'info',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Make AJAX request to store details
            $.ajax({
                url: '/store-details', // Adjust URL as needed
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Add CSRF token
                    name: selectedName,
                    grade: selectedGrade,
                    section: selectedSection,
                    department: selectedDepartment,
                    transaction: selectedTransaction
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Details stored successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error storing details:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error storing the details. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});




   // Add change event listener to the select transaction element
   $('#transactionsBodyselect').change(function() {
        // Update selectedTransaction when the transaction selection changes
        selectedTransaction = $(this).find('option:selected').text();
        selectedTransactionId = $(this).val(); // Capture the selected transaction ID
    });

    // Function to populate selected name, grade, and section
    function populateSelectedDetails(student) {
        selectedName = student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname;
        selectedGrade = student.Grade;
        selectedSection = student.Section;
        selectedStudentId = student.Stud_id; // Capture the selected student ID
    }

    // Function to fetch and populate data based on entered name
    function fetchDataAndPopulate(enteredName) {
        $.ajax({
            url: '/fetch-students',
            type: 'GET',
            dataType: 'json',
            data: { name: enteredName },
            success: function(response) {
                $('#formTextContainer').empty();

                if (response && response.length > 0) {
                    var matchedStudents = response.filter(function(student) {
                        var fullName = (student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname).trim().toLowerCase();
                        return fullName.includes(enteredName.toLowerCase());
                    });

                    if (matchedStudents.length > 0) {
                        matchedStudents.forEach(function(student) {
                            var formattedData = $('<p>').text(student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname);

                            formattedData.click(function() {
                                $('#name1').val(student.Firstname + ' ' + student.Middlename + ' ' + student.Lastname);
                                $('#formTextContainer').empty();

                                // Append name, grade, and section information
                                populateSelectedDetails(student);
                                var nameInfo = $('<p>').text('Name: ' + selectedName);
                                var gradeInfo = $('<p>').text('Grade: ' + selectedGrade);
                                var sectionInfo = $('<p>').text('Section: ' + selectedSection);
                                $('#formTextContainer').append(nameInfo, gradeInfo, sectionInfo);

                                appendDoneButton(); // Add a "Done" button after clicking on a student's name
                            });

                            $('#formTextContainer').append(formattedData);
                        });
                    } else {
                        $('#formTextContainer').text('No students found matching "' + enteredName + '"');
                    }
                } else {
                    $('#formTextContainer').text('No students found for "' + enteredName + '"');
                }

                appendDoneButton(); // Add a "Done" button if there are no matching students
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                $('#formTextContainer').text('Error fetching data. Please try again.');
            }
        });
    }

    // Trigger fetchDataAndPopulate when user inputs a name
    $('#name1').on('input', function() {
        var enteredName = $(this).val();
        fetchDataAndPopulate(enteredName);
    });

    // Append Done button function
    function appendDoneButton() {
        var doneButton = $('<button>').text('Done').addClass('btn btn-primary btn-sm done-button');
        $('#formTextContainer').append(doneButton);

        // Add click event handler to prevent page reload
        doneButton.on('click', function(event) {
            event.preventDefault(); // Prevent page reload
            alert('Form submitted!');
        });
    }
});




    document.addEventListener('DOMContentLoaded', function() {
        const modalTriggers = document.querySelectorAll('.modal-trigger');

        modalTriggers.forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const modalTitle = document.querySelector('.modal-title');
                const modalBody = document.querySelector('.modal-body');

                modalTitle.textContent = target;

                const selectContent = `
                    <div class="form-group">
                        <label for="selectTransaction">Transaction for ${target}:</label>
                        <select class="form-control" id="selectTransaction">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                    </div>
                `;
                modalBody.innerHTML = selectContent;

                $('#myModal').modal('show');

                const saveButton = document.getElementById('saveButton');
                saveButton.addEventListener('click', function() {
                    const inputTransaction = document.getElementById('inputTransaction').value;
                    console.log(`Transaction for ${target}:`, inputTransaction);

                    $('#myModal').modal('hide');
                });
            });
        });
    });






    // // Inactivity carousel
    // let inactivityTime = function () {
    //     let time;
    //     let inactivityTimeout = 10000; // 10 seconds (10000 milliseconds)

    //     // Reset timer
    //     window.onload = resetTimer;
    //     window.onmousemove = resetTimer;
    //     window.onmousedown = resetTimer; // catches touchscreen presses
    //     window.ontouchstart = resetTimer;
    //     window.onclick = resetTimer; // catches touchpad clicks
    //     window.onkeypress = resetTimer;   
    //     window.addEventListener('scroll', resetTimer, true); // improved; see comments

    //     function showCoverPhoto() {
    //         $('#coverPhotoContainer').fadeIn();
    //     }

    //     function hideCoverPhoto() {
    //         $('#coverPhotoContainer').fadeOut();
    //     }

    //     function resetTimer() {
    //         clearTimeout(time);
    //         hideCoverPhoto();
    //         time = setTimeout(showCoverPhoto, inactivityTimeout);
    //     }
    // };

    // inactivityTime();
</script>

</body>
</html>
