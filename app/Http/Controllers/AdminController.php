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

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    
    public function viewdashboard(){

        $book = Book::all();

        $userCount = User::count();

        $recentActivity = Book::latest()->first();
        

        return view('admin.dashboard', compact('book', 'userCount', 'recentActivity'));
    }

    public function viewUsers(){
        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    public function deleteUser(Request $request, User $user){
        
        if ($user->exists()) {

            $user->delete();

            return redirect()->route('admin.manage_users')->with('success', 'User deleted successfully');
        }

        return back()->with('error', 'User not found');
    }
}
