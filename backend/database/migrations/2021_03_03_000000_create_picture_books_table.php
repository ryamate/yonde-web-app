<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('google_books_id', 100);
            $table->string('isbn_13', 100)->nullable();
            $table->string('title', 255);
            $table->string('authors', 255)->nullable();
            $table->string('published_date', 100)->nullable();
            $table->string('thumbnail_url', 1000)->nullable();
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
        Schema::dropIfExists('picture_books');
    }
}
