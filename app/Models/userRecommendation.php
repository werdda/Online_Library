<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Genre;

class userRecommendation extends Model
{
    use HasFactory;

    protected $table = 'recommendation';
    
    protected $fillable = [

        'user_id',
        'genre_id',
        'genreVisit_count'

    ];


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function genre(){

        return $this->belongsTo(Genre::class);
    }

}
