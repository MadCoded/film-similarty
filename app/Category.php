<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "CategoryID";

    protected $fillable = ["Name"];

    function movies()
    {
        return $this->belongsToMany('App\Movie', "movie_cat","CategoryID","MovieID");
    }
}
