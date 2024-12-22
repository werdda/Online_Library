<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function favourites(){

        if(Auth::check()){

            $user = Auth::user();
            $favourites = $user->favourites;
            return view('user.favorites', compact('favourites'));

        }

        return redirect()->back()->with('error', 'Must Be Logged In To Access Wishlist');
    }

    public function edit(Request $request, User $user){

        $validated = $request->validate([

            'name'=> 'nullable|string|max:255',
            'email'=> 'nullable|string|max:255',
            'profile_img'=>'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if($request->hasFile('profile_img')){

            if($user->profile_img && Storage::exists('public/profile_images/' . $user->profile_img)){

                Storage::delete(['public/profile_images/' . $user->profile_img]);
            }

            $image = $request->file('profile_img')->store('profile_images', 'public');;
            $imageURL = asset('storage/'.$image);
            
            $user->profile_img = $imageURL;
        }

        $user->save();

        // return view('user.profile');
        return redirect()->route('user.profile', $user)->with('success', 'Profile updated successfully.');
        
    }

    public function update_password(Request $request, User $user){

        
        if(!Hash::check($request->current_password, $user->password)){

            return back()->withErrors(['current_password'=>'current password incorrect!']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return view('user.profile');
    }


    public function search_favorites(Request $request){

        // dd($request->all());
        
        if($request->has('query') && !empty(trim($request->input('query')))){

            
            $query = $request->input('query');
            $usercollection = Auth::user()->favourites();
            $book_data = $usercollection->where('book_title', 'LIKE', "%{$query}%")
            ->orWhere('book_author', 'LIKE', "%{$query}%")
            ->orWhere('publisher', 'LIKE', "%{$query}%")
            ->paginate(2);
          
            $book_data->appends(['query'=>$query]);
            
            return view('user.favorites', compact('book_data', 'query'));

        }
        
        return back()->with('error','Empty Query... (did you accidentally pressed space?).');
    }
}
