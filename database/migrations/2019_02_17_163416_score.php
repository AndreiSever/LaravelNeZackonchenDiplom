<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Score extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('score')) {
            Schema::create('score', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->integer('score_document');
                $table->integer('id_document')->unsigned();
                $table->foreign('id_document')->references('id')->on('document');
                $table->dateTime('date');
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
        Schema::dropIfExists('score');
    }
}
