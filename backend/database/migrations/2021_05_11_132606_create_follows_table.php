<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('follower_user_id');
            $table->unsignedBigInteger('followee_family_id');
            $table->timestamps();

            $table->foreign('follower_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('followee_family_id')
                ->references('id')
                ->on('families')
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
        Schema::dropIfExists('follows');
    }
}
