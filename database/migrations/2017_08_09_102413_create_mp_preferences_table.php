<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string("mp_pref_id");
            $table->index("mp_pref_id");

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
        Schema::dropIfExists('mp_preferences');
    }
}
