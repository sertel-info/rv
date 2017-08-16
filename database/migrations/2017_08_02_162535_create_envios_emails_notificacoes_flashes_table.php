<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosEmailsNotificacoesFlashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_emails_notif_flash', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->boolean("status")->default(0);
            
            $table->integer('notif_flash_users_id')
                  ->unsigned();

            $table->foreign('notif_flash_users_id', 'notif_flash_users_id')
                  ->references('id')
                  ->on('notificacoes_flash_users')
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
        Schema::dropIfExists('envios_emails_notif_flash');
    }
}
