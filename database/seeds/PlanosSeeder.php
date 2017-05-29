<?php

use Illuminate\Database\Seeder;
use App\Models\Planos\Planos;

class PlanosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pla_class = new Planos;

        $pla_class->create([
	        		"nome"=>"Plano Um",
					"tipo"=>"pre",
					"valor_sms"=>0.30,
					"valor_fixo_local"=>0.34,
					"valor_fixo_ddd"=>0.20,
					"valor_movel_local"=>0.37,
					"valor_movel_ddd"=>0.23,
					"valor_ddi"=>1.50,
					"valor_ip"=>0.90,
					"descricao"=>'Plano Um é bom.'
        	]);

        $pla_class->create([
	        		"nome"=>"Plano Dois",
					"tipo"=>"pre",
					"valor_sms"=>0.30,
					"valor_fixo_local"=>0.34,
					"valor_fixo_ddd"=>0.20,
					"valor_movel_local"=>0.37,
					"valor_movel_ddd"=>0.23,
					"valor_ddi"=>1.50,
					"valor_ip"=>0.90,
					"descricao"=>'Plano Dois é bom.'
        	]);

        $pla_class->create([
	        		"nome"=>"Plano Três",
					"tipo"=>"pre",
					"valor_sms"=>0.30,
					"valor_fixo_local"=>0.34,
					"valor_fixo_ddd"=>0.20,
					"valor_movel_local"=>0.37,
					"valor_movel_ddd"=>0.23,
					"valor_ddi"=>1.50,
					"valor_ip"=>0.90,
					"descricao"=>'Plano Um é bom.'
        	]);
    }
}
