<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Add a New Book</title>
</head>
<body>

    @include('layouts.navbar')


    <div class="container mt-5">
        <h1 class="text-center mb-4">Add a New Book</h1>
    
        @if ($errors->has('genre_name'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('genre_name') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <form action="/books" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow">
            @csrf
    
            <div class="mb-3">
                <label for="book_title" class="form-label fw-bold">Book Title</label>
                <input type="text" name="book_title" id="book_title" class="form-control" placeholder="Enter book title" required>
            </div>
    
            <div class="mb-3">
                <label for="book_author" class="form-label fw-bold">Book Author</label>
                <input type="text" name="book_author" id="book_author" class="form-control" placeholder="Enter book author" required>
            </div>
    
            <div class="mb-3">
                <label for="publisher" class="form-label fw-bold">Publisher</label>
                <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Enter publisher name" required>
            </div>
    
            <div class="mb-3">
                <label for="genre_name" class="form-label fw-bold">Genre Name</label>
                <input type="text" name="genre_name" id="genre_name" class="form-control" placeholder="Enter genre name" required>
            </div>
    
            <div class="mb-3">
                <label for="book_thumbnail" class="form-label fw-bold">Book Thumbnail</label>
                <input type="file" name="book_thumbnail" id="book_thumbnail" class="form-control" accept="image/*" required>
            </div>
    
            <div class="mb-3">
                <label for="pdf_file" class="form-label fw-bold">Book PDF</label>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf">
            </div>
    
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Add Book</button>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>

@include('layouts.footer')
</html>