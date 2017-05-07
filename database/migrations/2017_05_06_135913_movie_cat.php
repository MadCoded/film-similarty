<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovieCat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_cat', function (Blueprint $table) {
            $table->integer('MovieID')->unsigned();
            $table->foreign('MovieID')->references('MovieID')
                ->on('movies')->onDelete('cascade');

            $table->integer('CategoryID')->unsigned();
            $table->foreign('CategoryID')->references('CategoryID')
                ->on('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_cat');
    }
}
