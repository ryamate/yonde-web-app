<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureBookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_book_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('picture_book_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('picture_book_id')
                ->references('id')
                ->on('picture_books')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture_book_tag');
    }
}
