<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesFlashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes_flash', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text("mensagem");
            $table->string("titulo");
            $table->string("nivel", 25);
            $table->boolean("ativar_email")->default(0);
            $table->string("email_assunto", 200)->nullable();
            $table->text("email_corpo")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacoes_flash');
    }
}
