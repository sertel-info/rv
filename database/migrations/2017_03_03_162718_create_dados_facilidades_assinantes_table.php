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

            $table->boolean("acesso_ramais")->default(false);
            $table->boolean("portal_voz")->default(false);
            $table->boolean("sala_conferencia")->default(false);
            $table->boolean("fila_atendimento")->default(false);
            $table->boolean("ura_atendimento")->default(false);
            $table->boolean("envio_sms")->default(false);
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
