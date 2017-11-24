<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGravacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-asterisk-logs')->table('gravacoes', function($table)
        {
            if(Schema::connection('mysql-asterisk-logs')->hasColumn('gravacoes', 'duracao'))
                $table->dropColumn('duracao');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('atualizacoes_creditos', 'valor_anterior')){
             Schema::table('atualizacoes_creditos', function($table)
            {
               $table->dropColumn('valor_anterior');
            });
        }
    }
}
