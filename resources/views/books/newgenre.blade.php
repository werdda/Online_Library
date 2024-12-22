<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Manage Genres</title>
</head>

<body>

    @include('layouts.navbar')

    <div class="container mt-3">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button onclick="window.location.href='{{ route('genre.index') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        <button onclick="window.location.href='{{ route('genre.index') }}'" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Check If User is Logged In and is an Admin to Which Display a Button to Admin Dashboard --}}
    @if(Auth::user() && Auth::user()->isAdmin())

        <a href="/admin/dashboard">
            <button class="btn btn-primary position-fixed top-136px end-0 m-3" style="z-index: 1050; top: 136px">
            <i class="bi bi-book"></i> <!-- Bootstrap icon book -->
            </button>
        </a>

    @endif
    

    <h1 style="font-family: Inter; font-weight: 800; padding-top: 50px; padding-left: 72px">Manage Genres</h1>

    <div class="container text-center" style="padding-top: 51px">
        {{-- Display Existing Genres --}}
        @if (isset($genre))
            <div class="row">
                @foreach ($genre as $genres)
                    <div class="col-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                @if($genres->genre_thumbnail)
                                    <img src="{{ $genres->genre_thumbnail }}" alt="genre_thumbnail" class="img-fluid mb-2">
                                @endif
                                <h4>{{ $genres->book_genre }}</h4>
                                
                                {{-- Edit Button --}}
                                <a href="{{ route('genre.edit', $genres->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                {{-- Delete Button --}}
                                <form action="{{ route('genre.destroy', $genres->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this genre?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Add Genre Form --}}
    <div class="container mt-4">
        <h2>Add A New Genre</h2>
        <form action="{{ route('genre.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="genre_name" class="form-label">Genre Name:</label>
                <input type="text" class="form-control" name="genre_name" id="genre_name" required>
            </div>

            <div class="mb-3">
                <label for="genre_thumbnail" class="form-label">Genre Thumbnail:</label>
                <input type="file" class="form-control" name="genre_thumbnail" id="genre_thumbnail" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Add Genre</button>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    

    <div style="margin: 50px"></div>
</body>

    @include('layouts.footer')
</html>