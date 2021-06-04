<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredPictureBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_picture_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('picture_book_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('five_star_rating');
            $table->integer('read_status');
            $table->string('review', 1000)->nullable();
            $table->timestamps();

            $table->foreign('family_id')
                ->references('id')
                ->on('families');
            $table->foreign('picture_book_id')
                ->references('id')
                ->on('picture_books');
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
        Schema::dropIfExists('stored_picture_books');
    }
}