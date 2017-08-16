<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->increments('id');

            $table->text("mensagem");
            $table->boolean("status")->default(0);
            $table->string("nome", 40);
            //$table->string("tipo", 50);
            $table->string("titulo");
            $table->string("nivel", 25);
            $table->string("escutar_evento", 25);
            $table->boolean("ativar_email")->default(0);
            $table->string("email_assunto", 200)->nullable();
            $table->text("email_corpo")->nullable();

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
        Schema::dropIfExists('notificacoes');
    }
}
