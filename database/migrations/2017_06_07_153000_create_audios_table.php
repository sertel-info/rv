<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string("nome_original");
            $table->string("nome");
            $table->string("caminho");
            $table->string("extensao", 5);

            $table->integer("assinante_id")->unsigned();
            $table->foreign("assinante_id")
                  ->references("id")
                  ->on("assinantes")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audios');
    }
}
