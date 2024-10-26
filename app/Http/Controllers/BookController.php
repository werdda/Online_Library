<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $books = Book::all();
        $genre = Genre::all();
        return view('books.index', compact('books', 'genre'));
    }

    public function create(){

        return view('books.create');

    }

    public function store(Request $request){

        $book = new Book();
        $book->book_title = $request->book_title;
        $book->book_author = $request->book_author;
        $book->publisher = $request->publisher;
        $book->book_genre = $request->book_genre;
        $book->save();

        return redirect('/books');

    }

    public function search(Request $request){
        
        $books = collect();
        $genre = Genre::all();

        
        if($request->has('query') && !empty(trim($request->input('query')))){

            $query = $request->input('query');

            $books = Book::join('genre', 'books.genre_id', '=', 'genre.id')
            ->select('books.*', 'genre.book_genre as genre_name')
            ->where('book_title', 'LIKE', "%{$query}%")
            ->orWhere('book_author', 'LIKE', "%{$query}%")
            ->orWhere('publisher', 'LIKE', "%{$query}%")
            ->orWhere('book_genre', $query)
            ->get();

            return view('user.dashboard', compact('books', 'query', 'genre'));

        }

        if($request->has('genres')){

            // $selected = $request->input('genres');

            // $books = Book::join('genre', 'books.genre_id', '=', 'genre.id')
            // ->select('books.*', 'genre.book_genre as genre_name')
            // ->whereIn('genre_id', $selected)->get();

            $selected = $request->input('genres'); 
            $books = Book::with('genre')
            ->whereIn('genre_id', $selected)
            ->get();


            return view('user.dashboard', compact('books', 'genre'));
        }
        


        return view('user.dashboard', compact('genre'));
    }

}
