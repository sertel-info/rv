<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosConfiguracoesLinhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_configuracoes_linhas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('linha_id')->unsigned();
            $table->foreign('linha_id')
                      ->references('id')
                      ->on('linhas')
                      ->onDelete('cascade');

            $table->string('callerid', 20)->nullable();
            $table->string('envio_dtmf', 20);
            $table->boolean('ring_falso');
            $table->boolean('nat');

            $table->string('call_group', 20)->nullable();
            $table->string('pickup_group', 20)->nullable();
            $table->text('rotas_saida')->nullable(); //sera populado com json
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_configuracoes_linhas');
    }
}
