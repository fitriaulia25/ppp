<!-- resources/views/users/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</body>
</html>
