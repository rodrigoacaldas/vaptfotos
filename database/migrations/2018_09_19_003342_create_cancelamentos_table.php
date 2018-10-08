<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data')->nullable();
            $table->string('obs')->nullable();

            $table->integer('evento_id')->unsigned();
            $table->foreign('evento_id')->references('id')->on('eventos');

            $table->integer('tipocancelamento_id')->unsigned();
            $table->foreign('tipocancelamento_id')->references('id')->on('cancelamentos');

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
        Schema::dropIfExists('cancelamentos');
    }
}
