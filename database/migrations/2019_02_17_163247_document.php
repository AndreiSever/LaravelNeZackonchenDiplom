<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Document extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('document')) {
            Schema::create('document', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->string('name_document');
                $table->integer('id_tasks')->unsigned();
                $table->foreign('id_tasks')->references('id')->on('tasks');
                $table->integer('id_student')->unsigned();
                $table->foreign('id_student')->references('id')->on('users');
                $table->integer('id_permission')->unsigned();
                $table->foreign('id_permission')->references('id')->on('users');
                $table->string('message');
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
        Schema::dropIfExists('document');
    }
}
