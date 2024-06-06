<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
            margin-left: 240px;
            /* Default margin for open sidebar */
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
            width: 80px;
        }

        .sidebar li {
            height: 60px;
            list-style: none;
            display: flex;
            align-items: center;
            margin-top: 0px;
        }

        .sidebar .icon {
            min-width: 35px;
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .sidebar header .toggle {
            position: absolute;
            top: 50%;
            right: -20px;
            transform: translateY(-50%) rotate(180deg);
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

        .sidebar .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            transition: var(--tran-05);
        }

        .sidebar.close .logo {
            width: 40px;
            height: 40px;
        }

        .sidebar .menu {
            margin-top: 20px;
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
            height: calc(80% - 25px);
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

        .menu-bar .bottom-content .toggle-switch {
            position: absolute;
            right: 0;
            height: 120%;
            min-width: 30px;
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

        body.sidebar-close {
            margin-left: 70px;
            transition: var(--tran-05);
        }
    </style>
</head>

<body style="background-color: #ECF0F1;">
    <!-- Sidebar -->
    <nav class="sidebar close">
        <header>
            <img src="{{ asset('images/ck.jpg') }}" alt="Logo" class="logo">
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{ url('/home') }}">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ url('/newad') }}">
                            <i class='bx bxs-building-house icon'></i>
                            <span class="text nav-text">Department</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ url('/user') }}">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">User</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <div class="toggle-switch" style="margin-top: 30px;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <li style="display: inline-block; vertical-align: middle; margin-top: 5px;">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" id="logout-link">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                </div>

                </li>
            </div>
    </nav>

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
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Logged Out!',
                text: 'You have been successfully logged out.',
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
                willClose: () => {
                    document.getElementById('logout-form').submit();
                }
            });
        });
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav.sidebar'),
            toggle = body.querySelector(".toggle"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if (sidebar.classList.contains("close")) {
                body.classList.remove('sidebar-open');
                body.classList.add('sidebar-close');
            } else {
                body.classList.remove('sidebar-close');
                body.classList.add('sidebar-open');
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
        } else {
            body.classList.add('sidebar-open');
        }
    </script>
</body>

</html>
