<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildReadRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_read_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('read_record_id');
            $table->unsignedBigInteger('child_id');
            $table->timestamps();

            $table->foreign('read_record_id')
                ->references('id')
                ->on('read_records')
                ->onDelete('cascade');
            $table->foreign('child_id')
                ->references('id')
                ->on('children')
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
        Schema::dropIfExists('read_record_child');
    }
}
