<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaudacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saudacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string("nome", 15);
            $table->string("tipo_audio", 15);
            
            $table->boolean("ativo")->default(0);
            
            $table->integer("audio_id")->unsigned();
            $table->foreign("audio_id")
                  ->references("id")
                  ->on("audios");

            $table->integer("assinante_id")->unsigned();
            $table->foreign("assinante_id")
                  ->references("id")
                  ->on("assinantes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saudacoes');
    }
}
