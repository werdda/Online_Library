<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GenreController;
use App\Models\Genre;

use function Laravel\Prompts\search;

Auth::routes();

Route::get('/home', function () {
    
    return view('home');

});

Route::get('/', [BookController::class, 'search']);

Route::get('/user/dashboard', [BookController::class, 'search'])->name("user.dashboard");


Route::post('/logout', function () {

    Auth::logout();
    return redirect('/'); 
    
})->name('logout');


Route::get("/books", [BookController::class,'index'])->name('books.index');


Route::middleware([AuthMiddleware::class, AdminMiddleware::class])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'viewdashboard']);
    
    Route::get("/books/create", [BookController::class,'create'])->name('books.create');
    
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');

    Route::delete('/books/{book}/delete', [BookController::class, 'delete'])->name('books.destroy');

    Route::put('/books/{book}/update', [BookController::class, 'update'])->name('books.update');

    Route::resource('genre', GenreController::class)->except(['show']); 

    Route::get('admin/usermanagement', [AdminController::class, 'viewUsers'])->name('admin.manage_users');

    Route::delete('/admin/{user}/delete', [AdminController::class, 'deleteUser'])->name('user.destroy');

});


Route::post("/books", [BookController::class,'store']);

Route::get("/user/search", [BookController::class, 'search'])->name('user.search');

Route::post('/user/{book}/favourite', [BookController::class, 'favourite'])->name('user.favourite');

Route::get('/user/favorites', [UserController::class, 'favourites'])->name('user.favorites');

Route::get("/favorites/search", [UserController::class, 'search_favorites'])->name('search.favorites');


Route::middleware([AuthMiddleware::class])->group(function(){

    Route::get('/user/profile', function(){

        return view('user.profile');
    
    })->name('user.profile');

    Route::put('/user/{user}/profile', [UserController::class, 'edit'])->name('profile.update');


    Route::put('/user/{user}/password', [UserController::class, 'update_password'])->name('profile.password_update');

});


Route::get('/books/{book}/description', [BookController::class, 'description'])->name('book.desc');

Route::post('/books/{id}/rate', [BookController::class, 'rateBook'])->name('rateBook');

Route::get('/categories', [BookController::class, 'category'])->name('user.categories');

Route::get('/bestseller', [BookController::class, 'bestseller'])->name('user.bestseller');

Route::get('/support', function(){

    return view('user.support');
});


Route::get('search/{genreId}/category', [BookController::class, 'search_category'])->name('search.category');
Route::get('search/categoryname', [BookController::class, 'search_category_name'])->name('categoryname.search');
Route::get('/books/search', [BookController::class, 'book_index_search'])->name('index.search');

Route::get('/books/{book}/read', [BookController::class, 'readPdf'])->name('book.viewPdf');
