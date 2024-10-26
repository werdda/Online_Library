<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;

use function Laravel\Prompts\search;

Auth::routes();

Route::get('/home', function () {
    
    return view('home');

});


Route::get('/', function () {

    return view('welcome');
    
});


Route::get('/admin/dashboard', function () {

    return view('admin.dashboard');

});

Route::get('/user/dashboard', [BookController::class, 'search'])->name("user.dashboard");


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home after log out
})->name('logout');



Route::get("/books", [BookController::class,'index']);


Route::middleware([AuthMiddleware::class, AdminMiddleware::class])->group(function () {

    Route::get("/books/create", [BookController::class,'create']);
});

// Route::get("/books/create", [BookController::class,'create']);

Route::post("/books", [BookController::class,'store']);

Route::get("/user/search", [BookController::class, 'search'])->name('user.search');

