<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadRecordTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('read_record_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('read_record_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('read_record_id')
                ->references('id')
                ->on('read_records')
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
        Schema::dropIfExists('read_record_tag');
    }
}
