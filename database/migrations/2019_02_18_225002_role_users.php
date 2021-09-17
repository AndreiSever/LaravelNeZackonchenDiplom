<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('RoleUsers')) {
            Schema::create('RoleUsers', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->integer('id_role')->unsigned();
                $table->foreign('id_role')->references('id')->on('role');
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
