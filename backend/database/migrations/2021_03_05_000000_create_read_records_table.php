<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('read_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('picture_book_id');
            $table->unsignedBigInteger('record_user_id');
            $table->string('memo', 1000)->nullable();
            $table->date('read_date');
            $table->timestamps();

            $table->foreign('picture_book_id')
                ->references('id')
                ->on('picture_books')
                ->onDelete('cascade');
            $table->foreign('record_user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('read_records');
    }
}
