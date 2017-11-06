<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MpPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mp_preferences', function($table)
        {   
            $table->dropForeign(['assinante_id']);
            $table->foreign('assinante_id')
                  ->references('id')
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
        Schema::table('mp_preferences', function($table)
        {   
            if(Schema::hasColumn('mp_preferences', 'assinante_id')){
                $table->dropForeign(['assinante_id']);
                $table->dropColumn("assinante_id");
            }
            /*$table->integer("assinante_id")->unsigned();
            $table->foreign("assinante_id")
                  ->references("id")
                  ->on("assinantes");*/
        });
    }
}
