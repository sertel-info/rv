<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string("nome");
            $table->string("tipo");
            $table->integer("tempo_chamada");
            $table->boolean("regra_transbordo")->default(0);

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
        Schema::dropIfExists('filas');
    }
}
