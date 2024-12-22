<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ Auth::user()->name }} Profile</title>
</head>
<body>

    @include('layouts.navbar')
    
    <div class="flex-grow-1">
        <h1 class="p-5 fw-bold" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Profile Page</h1>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Profile Info Column -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ Auth::user()->profile_img ?? asset('storage/images/placeholder_profile.png') }}" class="card-img-top" alt="Profile Picture">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <p class="card-text">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile Edit Form Column -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', Auth::user()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="profile_img" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_img" name="profile_img">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="/user/profile" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="card mt-4 mb-4">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password_update', Auth::user()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>

                            <button type="submit" class="btn btn-danger">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

@include('layouts.footer')
</html>