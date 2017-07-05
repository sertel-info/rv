<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //$table->string("nome");
            $table->integer('assinante_id')
                  ->unsigned();

            $table->foreign('assinante_id')
                  ->references('id')
                  ->on('assinantes')
                  ->onDelete('cascade');

            /*$table->integer('linha_id')
                     ->unsigned();

            $table->foreign('linha_id')
                  ->references('id')
                  ->on('linhas')
                  ->onDelete('cascade');
            */

            $table->string("tipo_audio");
            
            $table->integer('audio_id')
                  ->unsigned()
                  ->nullable();

            $table->foreign('audio_id')
                  ->references('id')
                  ->on('audios')
                  ->onDelete('set null');

            for($i = 0; $i <10; $i++){
                $table->string("dig_".$i."_tipo")->nullable();
                $table->string("dig_".$i."_destino")->nullable();
            }

            $table->string("dig_tralha_tipo")->nullable();
            $table->string("dig_tralha_destino")->nullable();

            $table->string("dig_asteristico_tipo")->nullable();
            $table->string("dig_asteristico_destino")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uras');
    }
}
