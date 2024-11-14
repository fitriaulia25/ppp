<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
            border-left: 1px solid #dee2e6;
            margin-left: 250px;
        }
        .dashboard-overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .dashboard-card {
            flex: 1;
            padding: 20px;
            margin: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card:nth-child(1) {
            background-color: #f8d7da; /* Merah muda */
        }
        .dashboard-card:nth-child(2) {
            background-color: #d1ecf1; /* Biru muda */
        }
        .dashboard-card:nth-child(3) {
            background-color: #d4edda; /* Hijau muda */
        }
        .user-table-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="top-bar"> 
        <div class="d-flex align-items-center"> 
            <i class="fas fa-bars menu-icon" onclick="toggleSidebar()"></i> 
            <img src="{{ asset('img/lapas.png') }}" alt="Logo" class="logo"> 
            <span class="title">JurnalLasgar</span> 
        </div> 
        <div class="search-bar"> 
            <input type="text" class="form-control" id="searchInput" placeholder="Search"> 
            <i class="fas fa-search search-icon"></i> 
        </div> 
    </div> 
 
    <div class="sidebar-and-content"> 
        <div class ="sidebar"


id="sidebar"> 
            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a> 
            <a href="#"><i class="fas fa-users"></i> Users</a> 
            <a href="#"><i class="fas fa-cogs"></i> Settings</a> 
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
               <i class="fas fa-sign-out-alt"></i> Logout 
            </a> 
        </div> 

        <div class="main-content">
            <div class="container">
                <div class="dashboard-overview">
                    <div class="dashboard-card">
                        <div>
                            <span class="display-5">{{ $agendas->count() }}</span>
                            <h5>Total Agendas</h5>
                            <p>Jumlah agenda yang telah dibuat</p>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div>
                            <span class="display-5">{{ $atensi->count() }}</span>
                            <h5>Total Atensi</h5>
                            <p>Jumlah data atensi yang tercatat</p>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div>
                            <span class="display-5">{{ $users->count() }}</span>
                            <h5>Total Users</h5>
                            <p>Jumlah pengguna yang terdaftar</p>
                        </div>
                    </div>
                </div>

                <div class="user-table-section">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Users</h4>
                        <button class="btn btn-primary" onclick="window.location='{{ route('register') }}'">Create User</button>
                    </div>

                    <div class="search-bar mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" class="rounded-circle" width="40" height="40" alt="Avatar">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><i class="fas {{ $user->is_admin ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i></td>
                                <td><i class="fas {{ $user->has_user ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i></td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                     @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span>Showing 1-{{ $users->count() }} of {{ $users->total() }}</span>
                        <nav aria-label="Page navigation">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk melakukan pencarian
        function searchTable() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let table = document.getElementById('userTableBody');
            let rows = table.getElementsByTagName('tr');
    
              for (let i = 0; i < rows.length; i++) {
                let name = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
                let email = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase();
                if (name.includes(filter) || email.includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        // Tambahkan event listener ke input pencarian
        document.getElementById('searchInput').addEventListener('input', searchTable);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
