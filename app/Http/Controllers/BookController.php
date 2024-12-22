<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRating;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\userRecommendation;
use Symfony\Component\Console\Input\Input;

class BookController extends Controller
{
    public function index(){

        $books = Book::paginate(6);
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
        
        $find = Genre::where('book_genre', 'LIKE', "{$request->genre_name}")->first();

        if($find){

            $book->genre_id = $find->id;

        }else{

            return back()->withErrors(['genre_name' => 'The genre you entered doesnt exist.']);
        }
    
        $request->validate([

            'book_thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('book_thumbnail')){

            $imagePath = $request->file('book_thumbnail')->store('images', 'public');

            $imageURL = asset('storage/'.$imagePath);

            $book->book_thumbnail = $imageURL;

        }
        
        $pdfPath = null;

        if($request->hasFile('pdf_file')){
            
            $pdfPath = $request->file('pdf_file')->store('pdfs','public');
            $pdfURL = asset('storage/' . $pdfPath);
        }

        $book->pdf_file = $pdfURL;

        $book->save();

        return redirect('/books');

    }

    public function search(Request $request){
        
        $viewbooks = Book::with('ratings')->whereHas('ratings', function ($query) {
            $query->where('rating', '>=', 4);
        })
        ->get();
        $defaultview = Book::all();
        $books = collect();
        $genre = Genre::all();
        $favorites = Auth::check() ? Auth::user()->favourites()->pluck('book_id')->toArray() : [];
        
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

        if(Auth::check()){

            $userId = Auth::user()->id;
            $topGenre = userRecommendation::where('user_id', $userId)
            ->orderBy('genreVisit_count', 'desc')->limit(3)->pluck('genre_id');

            $recommendedBooks = Book::whereIn('genre_id', $topGenre)->get();

            if($recommendedBooks->isEmpty()){

                return view('user.dashboard', compact('genre', 'viewbooks', 'favorites', 'defaultview'));
            }

            return view('user.dashboard', compact('genre', 'viewbooks', 'favorites', 'recommendedBooks'));

        }



            
        return view('user.dashboard', compact('genre', 'viewbooks', 'favorites', 'defaultview'));
    }


    public function favourite(Request $request, Book $book){

        if(Auth::check()){

            $user = Auth::user();

            if(!$user->favourites()->where('book_id', $book->id)->exists()){

                $user->favourites()->attach($book->id);

                return response()->json(['status' => 'added']);

            }else{

                $user->favourites()->detach($book->id);
                return response()->json(['status' => 'removed']);
            }

            
        }

        return redirect()->route('login')->with('error', 'You Must Be Logged In To Add Favourites.');
    }

    public function delete(Request $request, Book $book){
        
        if($book->exists()){

            $book->delete();
            return redirect()->back()->with("success", "Book Deleted");

        }
        
    }

    
    public function update(Request $request, Book $book){

        $validated = $request->validate([

            'book_title' => 'required|string|max:255',
            'book_author' => 'required|string|max:255',
            'genre_name' => 'nullable|string|max:255',
            'book_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', 
        ]);

        // dd($request->all());
        

        if($request->hasFile('book_thumbnail')){

            $imagePath = $request->file('book_thumbnail')->store('images', 'public');

            $imageURL = asset('storage/'.$imagePath);

            $validated['book_thumbnail'] = $imageURL;

        }

        $pdfPath = null;

        if($request->hasFile('pdf_file')){
            
            $pdfPath = $request->file('pdf_file')->store('pdfs','public');
            $pdfURL = asset('storage/' . $pdfPath);
            $validated['pdf_file'] = $pdfURL;
        }


        if($request->has('genre_name')){

            $find = Genre::where('book_genre', 'LIKE', "{$request->input('genre_name')}")->first();

            if($find){

                $book->genre_id = $find->id;
                
            }else{

                return back()->withErrors(['genre_name' => 'The genre you entered doesnt exist.']);
            }
        }

        $book->update($validated);

        return redirect()->back()->with("success", "Book Updated");
    }

    public function edit(Book $book){

        return view('books.edit', compact('book'));
    }


    public function description(Book $book){

        $genreId = $book->genre_id;

        if(Auth::check()){

            $userVisit = userRecommendation::firstOrCreate(

                ['user_id' => Auth::id(), 'genre_id'=> $genreId],
                ['genreVisit_count' => 0]
            );
    
            $userVisit->increment('genreVisit_count');

            return view('books.description', compact('book'));
        }

        

        return view('books.description', compact('book'));
    }

    public function rateBook(Request $request, $bookId){

        $validated = $request->validate([

            'rating' => 'required|integer|min:1|max:5',

        ]);

        $book = Book::findOrFail($bookId);

        $existingrating = $book->ratings()->where('user_id', Auth::id())->first();

        if($existingrating){
            
            $existingrating->update(['rating' => $validated['rating']]);

        }else{

            $book->ratings()->create([

                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
            ]);
        }

        return redirect()->back()->with('success', 'Rating Submitted!');
    }


    public function category(Request $request){

        $genre = Genre::all();
        $books = collect();

        if($request->has('genres')){

        
            $selected = $request->input('genres'); 
            $books = Book::with('genre')
            ->whereIn('genre_id', $selected)
            ->paginate(6);

            $books->appends(['genres' => $selected]);

            if(!$books->isEmpty()){

                return view('user.categories', compact('books', 'genre'));

            }else{

                $selected = $selected[0] ?? null;

                $selected = Genre::where('genre.id', '=', $selected)->value('book_genre');
                return view('user.categories', compact('books', 'selected'));
            }

        }
        
        return view('user.categories', compact('genre'));
    }

    
    public function search_category(Request $request, $genreId){


        $categorybooks = collect();

        if($request->has('query') && !empty(trim($request->input('query')))){

            $query = $request->input('query');

            $categorybooks = Book::where('book_title', 'LIKE', "%{$query}%")
            ->orWhere('book_author', 'LIKE', "%{$query}%" )
            ->orWhere('publisher', 'LIKE', "%{$query}%")
            ->where('genre_id', "=",$genreId)
            ->paginate(6);

            $categorybooks->appends(['query'=> $query]);

            return view('user.categories', compact('categorybooks', 'query'));
        }

        return back()->with('error', 'No Genre Available (Did You Accidentally Pressed Enter?)');

    }

    public function search_category_name(Request $request){

        
        if($request->has('query') && !empty(trim($request->input('query')))){

            $query = $request->input('query');

            $categoryname = Genre::where('book_genre', 'LIKE', "%{$query}%")
            ->get();

            
            return view('user.categories', compact('categoryname', 'query'));

        }

        return back()->with('error', 'No Genre Available (Did You Accidentally Pressed Enter?)');

    }


    public function book_index_search(Request $request){

        // dd($request->all());

        if($request->has('query') && !empty(trim($request->input('query')))){

            $query = $request->input('query');

            $books_data = Book::where('book_title', 'LIKE', "%{$query}%")
            ->orWhere('book_author', 'LIKE', "%{$query}%")
            ->orWhere('publisher', 'LIKE', "%{$query}%")
            ->paginate(6);

            $books_data->appends(['query' => $query]);
            return view('books.index', compact('books_data', 'query'));

        }

        return back()->with('error', 'No Books Found (Did You Accidentally Pressed Enter?)');
    }

    public function bestseller(Request $request){

        $viewbooks = Book::with('ratings')->whereHas('ratings', function ($query) {
            $query->where('rating', '>=', 4);
        })
        ->get();


        if($request->has('query') && !empty(trim($request->input('query')))){

           $query = $request->input('query');

           $books_data = Book::with('ratings')->whereHas('ratings', function($query){

            $query->where('rating', '>=', 4);

           })
           ->where(function ($q) use ($query) {
            $q->where('book_title', 'LIKE', "%{$query}%")
              ->orWhere('book_author', 'LIKE', "%{$query}%")
              ->orWhere('publisher', 'LIKE', "%{$query}%");
            })
            ->get();

        

           return view('user.bestseller', compact('books_data', 'query'));
        }

        if($request->has('query') && empty(trim($request->input('query')))){

            return back()->with('error', 'No Books Found (Did You Accidentally Pressed Enter?)');
        }


        return view('user.bestseller', compact('viewbooks'));
    }

    public function readPdf($id){

        $book = Book::findOrFail($id);

        return view('books.readPdf', compact('book'));
    }

}
