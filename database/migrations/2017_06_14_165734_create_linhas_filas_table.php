<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinhasFilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linhas_filas', function (Blueprint $table) {
            //$table->increments('id');
            //$table->timestamps();

            $table->integer('posicao');
            $table->integer('fila_id')->unsigned();
            $table->integer('linha_id')->unsigned();

            $table->foreign('fila_id')
                  ->references('id')
                  ->on('filas')
                  ->onDelete('cascade');

            $table->foreign('linha_id')
                  ->references('id')
                  ->on('linhas')
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
        Schema::dropIfExists('linhas_filas');
    }
}
