<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Add a New Book</title>
</head>
<body>
    <h1>Add a New Book</h1>
    <form action="/books" method="POST">
    
        @csrf
        <label for="book_title">Book Title:</label>
        <input type="text" name="book_title" id="book_title" required><br><br>
        <label for="book_author">Book Author:</label>
        <input type="text" name="book_author" id="book_author" required><br><br>
        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="publisher" required><br><br>
        <label for="book_genre">Book Genre</label>
        <input type="text" name="book_genre" id="book_genre" required><br><br>
    
        <button type="submit">Add Book</button>
    
    </form>
</body>
</html>