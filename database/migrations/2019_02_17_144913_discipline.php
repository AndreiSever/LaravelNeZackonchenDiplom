<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Discipline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('discipline')) {
            Schema::create('discipline', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->string('name')->unique();
                $table->integer('id_group')->unsigned();
                $table->foreign('id_group')->references('id')->on('group');
                $table->integer('id_teacher')->unsigned();
                $table->foreign('id_teacher')->references('id')->on('users');
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
        Schema::dropIfExists('discipline');
    }
}
