<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Version extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('version')) {
            Schema::create('version', function (Blueprint $table) {
                $table->engine='innoDB';
                $table->increments('id');
                $table->integer('id_document')->unsigned();
                $table->foreign('id_document')->references('id')->on('document');
                $table->string('name_document');
                $table->integer('number_version');
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
        Schema::dropIfExists('version');
    }
}
