<?php

namespace App\Http\Controllers;

use App\Category;
use App\Movie;
use Illuminate\Http\Request;
use Mockery\Exception;

class MovieController extends Controller
{

    public function suggest($name)
    {
        $movie = Movie::where("Name", $name)->with("categories")->first();
        $pluckCats = $movie->categories()->pluck("Name")->toArray();

        $movies = Movie::with("categories")->where("MovieID", "!=", $movie->MovieID)->get();

        foreach ($movies as $movie) {
            $result = array_intersect($movie->categories()->pluck("Name")->toArray(), $pluckCats);
            $movie->Intersect = $result;
            $movie->Percent = round(count($result) * 100 / count($pluckCats), 0) . "%";
        }

        return $this->printSuggestion($movies);
    }

    public function printSuggestion($movies)
    {
        $sorted = $movies->sortByDesc('Intersect');

        echo "Suggestion : " . $sorted[count($sorted) - 1]->Name . " (" . $sorted[count($sorted) - 1]->Percent . ")";

        echo "<br>";
        echo "<ul>";
        foreach ($movies as $movie) {
            echo "<li>";
            echo $movie->Name . " (" . $movie->Percent . ")";
            echo "</li>";
        }
        echo "</ul>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with("categories")->get();

        echo "<ul>";
        foreach ($movies as $movie){
            echo "<li>".$movie->Name." (".$movie->categories()->pluck("Name")->implode(",").")";
        }
        echo "</ul>";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response("Not Implemented", 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->Name = $request->name;
        $cats = explode(",", $request->category);

        $catsIDs = [];
        for ($i = 0; $i < count($cats); $i++) {
            $cat = Category::firstOrCreate(['Name' => $cats[$i]]);
            array_push($catsIDs, $cat->CategoryID);
        }

        try {
            $movie->save();
            $movie->categories()->attach($catsIDs);
            return response()->json(["NewID" => $movie->MovieID]);
        } catch (Exception $e) {
            return response("Error", 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param Movie $movie
     */
    public function show(Request $request)
    {
        $movie = Movie::where("MovieID", $request->movie)->with("categories")->first();

        if ($movie) {
            return response()->json($movie);
        } else {
            return response("Not Found", 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return response("Not Implemented", 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        return response("Not Implemented", 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        return response("Not Implemented", 501);
    }
}
