<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";
    protected $primaryKey = "MovieID";

    protected $fillable = ["Name"];


    public function categories()
    {
        return $this->belongsToMany('App\Category', "movie_cat", "MovieID", "CategoryID");
    }


}
