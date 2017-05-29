<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linhas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('assinante_id')->unsigned()
                                           ->nullable();

            $table->foreign('assinante_id')
                      ->references('id')
                      ->on('assinantes')
                      ->onDelete('set null');

            $table->string("tecnologia", 10);
            $table->string("nome", 25);
            $table->integer("ddd_local")->nullable();
            $table->integer('simultaneas')->nullable();
            $table->string("funcionalidade", 15);
            $table->boolean("status_did")->default(0);
            $table->boolean("cli")->default(0);
            //seria json, mas deu erro no mysql, e deixei varchar pra depois mudar
            $table->string("codecs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linhas');
    }
}
