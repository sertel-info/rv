<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->bigInteger("mp_id");
            
            $table->integer("assinante_id")
                  ->unsigned();

            $table->foreign("assinante_id")
                    ->references("id")
                    ->on("assinantes")
                    ->onDelete("cascade");

            $table->string("mp_status", 55);
            $table->string("rv_status", 55);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mp_payments');
    }
}
