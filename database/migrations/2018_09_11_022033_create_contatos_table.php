<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data')->nullable();
            $table->string('followup');

            $table->integer('evento_id')->unsigned();
            $table->foreign('evento_id')->references('id')->on('eventos');

            $table->integer('meiocontato_id')->unsigned();
            $table->foreign('meiocontato_id')->references('id')->on('meio_contatos');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
