<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Profile</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3 text-center">
                    @if($user->photo)
                        <img id="profileImage" src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="img-fluid img-thumbnail" style="width: 150px; height: 150px;">
                    @else
                        <i class="bi bi-person-circle" style="font-size: 150px; color: gray;"></i>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" name="old_password" class="form-control" id="old_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Change Profile Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo" onchange="previewImage(event)">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event) {
            const profileImage = document.getElementById('profileImage');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                profileImage.src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                profileImage.src = ""; // Reset jika tidak ada file
            }
        }
    </script>
</body>
</html>
