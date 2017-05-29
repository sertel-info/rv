<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            /** gerais **/
            $table->string('prefx_aplicacoes', 20)->nullable();
            $table->string('atalho_siga_me', 20)->nullable();
            $table->string('atalho_cadeado', 20)->nullable();

            /** voice mail **/
            $table->string('voice_mail_assunto_padrao')->nullable();
            $table->string('voice_mail_remetente_padrao')->nullable();
            $table->string('voice_mail_mensagem_padrao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracoes');
    }
}
