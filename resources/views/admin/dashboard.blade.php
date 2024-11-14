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
            margin: 0 10px;
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
            background-color: #ffffff;
            padding: 20px;
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100vh - 60px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
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
            margin-left: 250px;
        }
        .content-box {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .content-box .box {
            width: 24%;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .box-atensi { background-color: #4CAF50; }
        .box-agenda { background-color: #FFA500; }
        .box-akun { background-color: #FF5733; }
        .box-admin { background-color: #007bff; }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="d-flex align-items-center">
            <i class="fas fa-bars menu-icon"></i>
            <img src="{{ asset('img/lapas.png') }}" alt="Logo" class="logo">
            <span class="title">JurnalLasgar</span>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>

    <div class="sidebar-and-content">
        <div class="sidebar" id="sidebar">
            <h4>Dashboard</h4>
            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#"><i class="fas fa-chart-line"></i> Statistics</a>
            <a href="#"><i class="fas fa-user"></i> User Profile</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="main-content" id="mainContent">
            <h3>Dashboard <span class="text-muted">Administrator</span></h3>

            <div class="content-box">
                <div class="box box-atensi">
                    <h2>Atensi</h2>
                    <p>Jumlah Atensi: {{ $atensiCount }}</p>
                    <button onclick="showDetail('Atensi', 'Jumlah atensi yang ada: {{ $atensiCount }}')" class="btn btn-light">Lihat Detail Atensi</button>
                </div>
                <div class="box box-agenda">
                    <h2>Agenda</h2>
                    <p>Jumlah Agenda: {{ $agendaCount }}</p>
                    <button onclick="showDetail('Agenda', 'Jumlah agenda yang ada: {{ $agendaCount }}')" class="btn btn-light">Lihat Detail Agenda</button>
                </div>
                <div class="box box-akun">
                    <h2>Akun</h2>
                    <p>Jumlah Akun: {{ $userCount }}</p>
                    <button onclick="showDetail('UserAkun', 'Jumlah akun yang ada: {{ $userCount }}')" class="btn btn-light">Lihat Detail User akun</button>
                </div>
            </div>

            <div class="user-table-section mt-4">
                <div class="d-flex justify-content-between align-items-center"> 
                    <button class="btn btn-primary" onclick="window.location='{{ route('register') }}'">Create User</button>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>ismi nurunizqi</td>
                                <td>ismi</td>
                                <td>ismi</td>
                                <td>isminurunizqi@gmail.com</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>mitsuki tok</td>
                                <td>mitsuki</td>
                                <td>mitsuki</td>
                                <td>mitsuki@gmail.com</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>sarada uchiha</td>
                                <td>sarada</td>
                                <td>sarada</td>
                                <td>sarada@gmail.com</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>sasuke uchiha</td>
                                <td>sasuke</td>
                                <td>sasuke</td>
                                <td>sasuke@gmail.com</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>shikadai nara</td>
                                <td>shikadai</td>
                                <td>shikadai</td>
                                <td>shikadai@gmail.com</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Edit</button>
                                  <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(title, message) {
            alert(title + ": " + message);
        }
    </script>
</body>
</html>
