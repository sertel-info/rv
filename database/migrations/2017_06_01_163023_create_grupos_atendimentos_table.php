<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_atendimento', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('tipo');
            $table->string('nome');
            $table->integer('tempo_chamada');
                        
            $table->integer('assinante_id')->unsigned();
            $table->foreign('assinante_id')
                  ->references('id')
                  ->on('assinantes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_atendimento');
    }
}
