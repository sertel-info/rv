<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GruposLinhas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_linhas', function (Blueprint $table) {
            $table->increments('id');
            //$table->timestamps();

            $table->integer("posicao");

            $table->integer("grupo_id")->unsigned();
            $table->foreign("grupo_id")
                        ->references("id")
                        ->on("grupos_atendimento")
                        ->onDelete('cascade');

            $table->integer("linha_id")->unsigned();

            $table->foreign("linha_id")
                    ->references("id")
                    ->on("linhas")
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
        Schema::dropIfExists('grupos_linhas');
    }
}
