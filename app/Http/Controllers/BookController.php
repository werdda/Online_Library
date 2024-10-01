<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create(){

        return view('books.create');

    }

    public function store(Request $request){

        $book = new Book();
        $book->book_title = $request->book_title;
        $book->book_author = $request->book_author;
        $book->publisher = $request->publisher;
        $book->save();

        return redirect('/books');

    }


}
