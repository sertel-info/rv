<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConfiguraces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracoes', function($table)
        {
            $table->string('prefx_monitoramento', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        if(Schema::hasColumn('configuracoes', 'prefx_monitoramento')){
            
            Schema::table('configuracoes', function($table)
            {   
                $table->dropColumn('prefx_monitoramento');
            });

        }

    }
}
