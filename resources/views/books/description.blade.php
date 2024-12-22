<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ $book->book_title }}</title>
</head>
<body>
    @include('layouts.navbar')
    
    <div class="container my-5">
        <div class="row">
            <!-- Book Details -->
            <div class="col-md-4">
                <img src="{{ $book->book_thumbnail }}" alt="{{ $book->book_title }}" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h1>{{ $book->book_title }}</h1>
                <p><strong>Author:</strong> {{ $book->book_author }}</p>
                <p><strong>Genre:</strong> {{ $book->genre->book_genre }}</p>
                <p><strong>Average Rating:</strong> {{ number_format($book->averageRating(), 1) }} ⭐</p>
            </div>
        </div>
    
        <!-- Star Rating -->
        @if(Auth::check())
        <div class="my-4">
            <form method="POST" action="{{ route('rateBook', $book->id) }}">
                @csrf
                <label for="rating" class="form-label">Rate this book:</label>
                <select name="rating" id="rating" class="form-select w-25">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
        @endif
    
        <!-- PDF Actions -->
        <div class="my-4">
            <a href="{{ route('book.viewPdf', $book->id) }}" class="btn btn-secondary">Read PDF</a>
            <a href="{{ $book->pdf_file }}" class="btn btn-success" download>Download PDF</a>
        </div>
    </div>
    
        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body> 
@include('layouts.footer')
</html>