<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Books List</title>
</head>
<body>

    <h1>Books</h1>
    <a href="/books/create">Add A New Book</a>
    <ul>
        @foreach ($books as $book)

            <li>{{ $book->book_title }} by {{ $book->book_author }} published by {{ $book->publisher }}</li>
            
        @endforeach
    </ul>

    <h1>Genre</h1>
    
    <ul>
        @foreach ($genre as $genres)

            <li>{{ $genres->book_genre }}</li>
            
        @endforeach
    </ul>
    
</body>
</html>