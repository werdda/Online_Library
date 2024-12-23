<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genre';

    public function books(){

        return $this->hasMany(Book::class);
    }

    public function userVisit(){

        return $this->hasMany(userRecommendation::class);
    }
}
