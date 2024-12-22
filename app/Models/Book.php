<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\User;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [

        'book_title',
        'book_author',
        'publisher',
        'book_thumbnail',
        'genre_id',
        'pdf_file',

    ];

    public function genre(){

        return $this->belongsTo(Genre::class);
    }

    public function favouritedBy(){

        return $this->belongsToMany(User::class, 'favourite_table', 'book_id', 'user_id');
    }

    public function ratings(){
        
        return $this->hasMany(BookRating::class);
    }

    public function averageRating(){

        return $this->ratings()->avg('rating');
    }
}
