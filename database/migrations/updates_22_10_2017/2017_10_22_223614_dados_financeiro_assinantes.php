<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DadosFinanceiroAssinantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_financeiro_assinantes', function($table)
        {
            $table->integer('dia_vencimento')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dados_financeiro_assinantes', function($table)
        {
            if(!Schema::hasColumn('dados_financeiro_assinantes', 'dia_vencimento')){
                Schema::table('dados_financeiro_assinantes', function($table)
                {
                      $table->integer("dia_vencimento");
                });
            }

        });
    }
}
