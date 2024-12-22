<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>
    
    @include('layouts.navbar')

    @if ($errors->has('genre_name'))
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            {{ $errors->first('genre_name') }}
            <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
  
    <div class="container my-5">
        <h1>Edit Book</h1>
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Book Title -->
            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" name="book_title" id="book_title" class="form-control" value="{{ $book->book_title }}" required>
            </div>
    
            <!-- Book Author -->
            <div class="mb-3">
                <label for="book_author" class="form-label">Book Author</label>
                <input type="text" name="book_author" id="book_author" class="form-control" value="{{ $book->book_author }}" required>
            </div>
    
            <!-- Genre -->
            <div class="mb-3">
                <label for="genre_name" class="form-label">Book Genre</label>
                <input type="text" name="genre_name" id="genre_name" class="form-control" value="{{ $book->genre->book_genre }}" required>
            </div>
    
            <!-- Book Thumbnail -->
            <div class="mb-3">
                <label for="book_thumbnail" class="form-label">Book Thumbnail</label>
                @if($book->book_thumbnail)
                    <div class="mb-2">
                        <img src="{{ $book->book_thumbnail }}" alt="Book Thumbnail" class="img-fluid" style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" name="book_thumbnail" id="book_thumbnail" class="form-control" accept="image/*">
            </div>
    
            <!-- PDF File -->
            <div class="mb-3">
                <label for="pdf_file" class="form-label">Book PDF File</label>
                @if($book->pdf_file)
                    <p>Current PDF: <a href="{{ $book->book_pdf }}" target="/book/readPdf">View File</a></p>
                @endif
                <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf">
            </div>
    
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>

@include('layouts.footer')
</html>