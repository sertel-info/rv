<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosPermissoesLinhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_permissoes_linhas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('linha_id')->unsigned();
            $table->foreign('linha_id')
                      ->references('id')
                      ->on('linhas')
                      ->onDelete('cascade');
                                       
            $table->boolean("ligacao_fixo");
            $table->boolean("ligacao_internacional");
            $table->boolean("ligacao_movel");
            $table->boolean("ligacao_ip");
            $table->boolean("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_permissoes_linhas');
    }
}
