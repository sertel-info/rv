<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDadosFacilidadesAssinantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_facilidades_assinantes', function($table)
        {
            $table->boolean('acesso_cx_postal')->default(1);
            $table->boolean('acesso_siga_me')->default(1);   
            $table->boolean('acesso_at_automatico')->default(1);   
            $table->boolean('acesso_cadeado')->default(1);   
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dados_facilidades_assinantes', function($table)
        {   
            if(Schema::hasColumn('dados_facilidades_assinantes', 'acesso_cx_postal'))
                $table->dropColumn('acesso_cx_postal');
            
            if(Schema::hasColumn('dados_facilidades_assinantes', 'acesso_siga_me'))
                $table->dropColumn('acesso_siga_me');
            
            if(Schema::hasColumn('dados_facilidades_assinantes', 'acesso_at_automatico'))
                $table->dropColumn('acesso_at_automatico');

            if(Schema::hasColumn('dados_facilidades_assinantes', 'acesso_cadeado'))
                $table->dropColumn('acesso_cadeado');

        });
    }
}
