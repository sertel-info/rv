<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosFacilidadesLinhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_facilidades_linhas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('linha_id')->unsigned();
            $table->foreign('linha_id')
                      ->references('id')
                      ->on('linhas')
                      ->onDelete('cascade');

            $table->boolean("gravacao")->default(0);
            $table->boolean("cadeado_pessoal")->default(0);
            $table->boolean("siga_me")->default(0);
            $table->boolean("caixa_postal")->default(0);
            $table->string("cadeado_pin", 20)->nullable();
            $table->string("num_siga_me", 20)->nullable();
            $table->string("cx_postal_pw", 20)->nullable();
            $table->string("cx_postal_email", 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_facilidades_linhas');
    }
}
