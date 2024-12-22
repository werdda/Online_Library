<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookRating;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\userRecommendation;
use Symfony\Component\Console\Input\Input;

class GenreController extends Controller
{   

    public function create(){

        return view('books.newgenre');
    }

    public function index(Request $request){
        
        $genre = Genre::all();


        return view('books.newgenre', compact('genre'));

    }

    public function store(Request $request){


        $request->validate([

            'genre_name' => 'required|string|max:255',
            'genre_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $genre = new Genre();
        $genre->book_genre = $request->genre_name;

        if($request->hasFile('genre_thumbnail')){

            $imagePath = $request->file('genre_thumbnail')->store('images', 'public');

            $imageURL = asset('storage/'.$imagePath);

            $genre->genre_thumbnail = $imageURL;

        }

        $genre->save();

        return redirect()->route('genre.index')->with('success', "succesfully added new genre {$request->genre_name}");
    }

     // Show the edit genre form
     public function edit($id)
     {
         $genre = Genre::findOrFail($id);
         return view('books.editGenre', compact('genre'));
     }
 
     // Update genre details
     public function update(Request $request, $id)
     {
         $request->validate([
             'genre_name' => 'required|string|max:255',
             'genre_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
         ]);
 
         $genre = Genre::findOrFail($id);
         $genre->book_genre = $request->genre_name;
 
         if ($request->hasFile('genre_thumbnail')) {

            //  $filePath = $request->file('genre_thumbnail')->store('images','public');
            //  $genre->genre_thumbnail = $filePath;
            $imagePath = $request->file('genre_thumbnail')->store('images', 'public');

            $imageURL = asset('storage/'.$imagePath);

            $genre->genre_thumbnail = $imageURL;
         }
 
         $genre->save();
 
         return redirect()->route('genre.index')->with('success', 'Genre updated successfully!');
     }
 
     // Delete genre
     public function destroy($id)
     {
         $genre = Genre::findOrFail($id);
         $genre->delete();
 
         return redirect()->route('genre.index')->with('success', 'Genre deleted successfully!');
     }
}
