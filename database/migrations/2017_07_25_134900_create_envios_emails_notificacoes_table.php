<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosEmailsNotificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_emails_notificacoes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('notificacoes_users_id')
                  ->unsigned();

            $table->foreign('notificacoes_users_id')
                  ->references('id')
                  ->on('notificacoes_users')
                  ->onDelete('cascade');

            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('envios_emails_notificacoes');
    }
}
