<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesFlashUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes_flash_users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->boolean("vista")->default(0);
            
            $table->text("mensagem_compilada");
            $table->text("mensagem_email_compilada")->nullable();
            
            $table->integer('user_id')
                  ->unsigned();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('notificacao_flash_id')
                  ->unsigned();

            $table->foreign('notificacao_flash_id')
                    ->references('id')
                    ->on('notificacoes_flash')
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
        Schema::dropIfExists('notificacoes_flash_users');
    }
}
