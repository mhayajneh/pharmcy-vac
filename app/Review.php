<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'rating', 'title', 'body', 'pharm_id'];

    public static function getAvg($pharm){
       return Review::where('pharm_id', $pharm)->average('rating');
    }
}
