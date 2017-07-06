<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosContatoAssinantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_contato_assinantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
           
            $table->integer('assinante_id')->unsigned();
            $table->foreign('assinante_id')
                      ->references('id')
                      ->on('assinantes')
                      ->onDelete('cascade');
                      
            $table->string('cep', 10)->nullable();
            $table->string('endereco')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('fax')->nullable();
            $table->string('celular', 20)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_contato_assinantes');
    }
}
