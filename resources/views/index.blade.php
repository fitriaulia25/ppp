<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            background-color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .top-bar img.logo {
            max-width: 50px;
            height: auto;
            margin-right: 10px;
            margin-left: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-left: 10px;
        }

        .search-bar {
            position: relative;
            width: 30%;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #6c757d;
        }

        .sidebar-and-content {
            display: flex;
            margin-top: 60px;
        }

        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            position: fixed;
            top: 60px;
            left: -250px;
            height: calc(100vh - 60px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: left 0.3s ease;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            border-left: 1px solid #dee2e6;
            transition: margin-left 0.3s ease;
        }

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            margin-left: 0px;
            margin-right: 10px;
            color: #007bff;
        }

        .banner {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }

        .banner img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .overlay-text h2 {
            font-size: 36px;
            font-weight: bold;
        }

        .overlay-text p {
            font-size: 18px;
            margin-top: 10px;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c 757d;
        }

        .agenda-item {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #e7f0dc;
            border-radius: 5px;
            color: #000;
        }

        .dropdown-menu {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px 0;
            color: black;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #007bff;
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
        h4 {
    font-size: 24px; /* Increase font size */
    font-weight: bold; /* Make the font bold */
    color: #007bff; /* Change text color */
    margin-top: 20px; /* Add some space above the heading */
    margin-bottom: 10px; /* Add some space below the heading */
    border-bottom: 2px solid #007bff; /* Add a bottom border */
    padding-bottom: 5px; /* Add some padding below the text */
    text-transform: uppercase; /* Make the text uppercase */
}

.list-group {
    margin-bottom: 20px; /* Add space below the list */
}

.list-group-item {
    border: 1px solid #e0e0e0; /* Add a border to list items */
    border-radius: 5px; /* Round the corners */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.list-group-item:hover {
    background-color: #f1f1f1; /* Change background color on hover */
}
    </style>
</head>
<body>
    <div class="d-flex flex-column">
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <i class="fas fa-bars menu-icon" onclick="toggleSidebar()"></i>
                <img src="{{ asset('img/lapas.png') }}" alt="Logo" class="logo">
                <span class="title">JurnalLasgar</span>
            </div>
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
        <div class="sidebar-and-content">
        <div class="sidebar" id="sidebar">
    @auth
        @if (auth()->user()->hasRole('admin'))
            <!-- Sidebar for admin -->
            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a>
            <div class="dropdown">
                <a href="#" id="formsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-folder-open"></i> Forms
                </a>
                <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                    <li><a href="{{ route('agenda.create') }}"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                    <li><a href="{{ route('atensi.index') }}"><i class="fas fa-list"></i> Atensi</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#"><i class="fas fa-plus"></i> Another Form</a></li>
                </ul>
            </div>
        @elseif (auth()->user()->hasRole('superadmin'))
            <!-- Sidebar for super admin -->
            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard Super Admin</a>
            <div class="dropdown">
                <a href="#" id="formsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-folder-open"></i> Forms
                </a>
                <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                    <li><a href="{{ route('agenda.create') }}"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                    <li><a href="{{ route('atensi.index') }}"><i class="fas fa-list"></i> Atensi</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#"><i class="fas fa-plus"></i> Another Form</a></li>
                </ul>
            </div>
            @else
                        <!-- Sidebar for other roles -->
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <div class="dropdown">
                            <a href="#" id="formsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-folder-open"></i> Forms
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                                <li><a href="{{ route('agenda.create') }}"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                                <li><a href="{{ route('atensi.index') }}"><i class="fas fa-list"></i> Atensi</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#"><i class="fas fa-plus"></i> Another Form</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="#" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> Akun
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                <li><a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif

        <!-- Logout link available for all authenticated users -->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="fas fa-sign-out-alt"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endauth
</div>

            </div>
            <div class="main-content" id="mainContent">
                <div class="banner">
                    <img src="{{ asset('img/lapas2.jpg') }}" alt="Banner" class="img-fluid">
                    <div class="overlay-text">
                        <h2>S.I.A.P LAPAS KELAS IIA GARUT</h2>
                        <p>Sistem Informasi Agenda Pemasyarakatan</p>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h3>Informasi</h3>

    <!-- Display the latest agendas -->
    <h4>Latest Agenda</h4>
    <ul class="list-group">
        @foreach($latestAgendas as $agenda)
            <li class="list-group-item">
                <strong>{{ $agenda->acara_kegiatan }}</strong> - {{ $agenda->tanggal }} <br>
                <small>{{ $agenda->tempat }}</small>
            </li>
        @endforeach
    </ul>
    <h4>Latest Atensi</h4>
    <ul class="list-group">
        @foreach($latestAtensis as $atensi)
            <li class="list-group-item">
                <strong>{{ $atensi->kegiatan }}</strong> - {{ $atensi->tanggal_waktu }} <br>
                <small>{{ $atensi->yth}}</small>
            </li>
        @endforeach
    </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var mainContent = document.getElementById("mainContent");

            if (sidebar.classList.contains("show")) {
                sidebar.classList.remove("show");
                mainContent.style.marginLeft = "0";
            } else {
                sidebar.classList.add("show");
                mainContent.style.marginLeft = "250px";
            }
        }
    </script>
</body>
</html>