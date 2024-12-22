<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Edit Genre</title>
</head>
<body>
    @include('layouts.navbar')
    
    <div style="margin: 50px"></div>

    <div class="container">
        <h1>Edit Genre</h1>

        <!-- Success or Error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Check If User is Logged In and is an Admin to Which Display a Button to Admin Dashboard --}}
        @if(Auth::user() && Auth::user()->isAdmin())

            <a href="/admin/dashboard">
                <button class="btn btn-primary position-fixed top-136px end-0 m-3" style="z-index: 1050; top: 136px">
                    <i class="bi bi-book"></i> <!-- Bootstrap icon book -->
                </button>
            </a>

        @endif
        

        <!-- Edit Genre Form -->
        <form action="{{ route('genre.update', $genre->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="genre_name" class="form-label">Genre Name</label>
                <input type="text" class="form-control" id="genre_name" name="genre_name" value="{{ old('genre_name', $genre->book_genre) }}" required>
            </div>

            <div class="mb-3">
                <label for="genre_thumbnail" class="form-label">Genre Thumbnail</label>
                <input type="file" class="form-control" id="genre_thumbnail" name="genre_thumbnail" accept="image/*">
                <small>Current Thumbnail: <img src="{{ $genre->genre_thumbnail }}" alt="current thumbnail" style="width: 50px; height: 50px;"></small>
            </div>

            <button type="submit" class="btn btn-primary">Update Genre</button>
        </form>
    </div>

    <div style="margin: 50px"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

@include('layouts.footer')
</html>