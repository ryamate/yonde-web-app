<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredPictureBookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_picture_book_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stored_picture_book_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('stored_picture_book_id')
                ->references('id')
                ->on('stored_picture_books')
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
        Schema::dropIfExists('stored_picture_book_tag');
    }
}
