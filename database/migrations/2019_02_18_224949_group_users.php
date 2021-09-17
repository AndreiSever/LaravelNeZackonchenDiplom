<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('GroupUsers')) {
            Schema::create('GroupUsers', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->integer('id_group')->unsigned();
                $table->foreign('id_group')->references('id')->on('group');
                $table->integer('id_users')->unsigned();
                $table->foreign('id_users')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GroupUsers');
    }
}
