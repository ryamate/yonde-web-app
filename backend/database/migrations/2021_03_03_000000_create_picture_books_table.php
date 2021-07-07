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
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('user_id');
            $table->string('google_books_id', 100);
            $table->string('isbn_13', 100)->nullable();
            $table->string('title', 255);
            $table->string('authors', 255)->nullable();
            $table->string('published_date', 100)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('thumbnail_url', 1000)->nullable();
            $table->integer('five_star_rating');
            $table->integer('read_status');
            $table->string('review', 1000)->nullable();
            $table->timestamps();

            $table->foreign('family_id')
                ->references('id')
                ->on('families');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
