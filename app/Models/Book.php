<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;

    public function genre(){

        return $this->belongsTo(Genre::class);
    }
}
