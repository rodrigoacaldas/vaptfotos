<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->string('dtevento');
            $table->string('hora')->nullable();

            $table->integer('qtdconvidados_id')->unsigned();
            $table->foreign('qtdconvidados_id')->references('id')->on('qtd_convidados');

            $table->integer('qtdfotos_id')->unsigned();
            $table->foreign('qtdfotos_id')->references('id')->on('qtd_fotos');

            $table->integer('tipoeventos_id')->unsigned();
            $table->foreign('tipoeventos_id')->references('id')->on('tipo_eventos');

            $table->integer('tipofotos_id')->unsigned();
            $table->foreign('tipofotos_id')->references('id')->on('tipo_fotos');

            $table->string('obs')->nullable();
            $table->boolean('scrapbook')->nullable();
            $table->boolean('adesivo')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->decimal('valorContrato')->nullable();
            $table->decimal('valorPago')->nullable();


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
        Schema::dropIfExists('eventos');
    }
}
