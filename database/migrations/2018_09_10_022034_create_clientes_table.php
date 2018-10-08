<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->date('nascimento')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('empresa')->nullable();
            $table->string('cpf')->nullable();
            $table->string('endereço')->nullable();

            $table->integer('comoconheceu_id')->unsigned();
            $table->foreign('comoconheceu_id')->references('id')->on('conheceus');

            $table->integer('meiocontato_id')->unsigned();
            $table->foreign('meiocontato_id')->references('id')->on('meio_contatos');

            $table->date('primeiroContato')->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
