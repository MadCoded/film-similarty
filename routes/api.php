<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|git
*/


Route::group(['middleware' => 'api'], function () {
    Route::resource("movie", "MovieController");
    Route::get("movie/{name}/suggest", "MovieController@suggest"); // name yerine tabiki ID olmalıydı. Bu göstermeklik

    Route::get('find/{movieName}', function ($movieName) {
        $movie = \App\Movie::where("Name", $movieName)
            ->with("categories")
            ->has("categories")
            ->first()
            ->categories()
            ->get();
        dd($movie);
    });
});