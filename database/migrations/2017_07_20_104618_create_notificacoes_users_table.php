<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes_users', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean("vista")->default(0);
            
            $table->text("mensagem_compilada");
            $table->text("mensagem_email_compilada")->nullable();
            
            $table->integer('user_id')
                  ->unsigned();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('notificacao_id')
                  ->unsigned();

            $table->foreign('notificacao_id')
                    ->references('id')
                    ->on('notificacoes')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('notificacoes_users');
    }
}
