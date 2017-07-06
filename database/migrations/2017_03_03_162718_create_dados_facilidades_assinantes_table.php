<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosFacilidadesAssinantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_facilidades_assinantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('assinante_id')->unsigned();
            $table->foreign('assinante_id')
                      ->references('id')
                      ->on('assinantes')
                      ->onDelete('cascade');

            $table->boolean("correio_voz")->default(false);
            $table->boolean("grupos_atendimento")->default(false);
            $table->boolean("fila")->default(false);
            $table->boolean("ura")->default(false);
            $table->boolean("gravacoes")->default(false);
            $table->boolean("acesso_extrato")->default(false);
            $table->boolean("saudacoes")->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_facilidades_assinantes');
    }
}
