<?php
//namespace Database\factories\Assinantes;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Linhas\DadosPermissoesLinhas::class, function (Faker\Generator $faker) {

    return [
    		"ligacao_fixo"=>rand(0,1),
			"ligacao_internacional"=>rand(0,1),
			"ligacao_movel"=>rand(0,1),
			"ligacao_ip"=>rand(0,1),
			"status"=>rand(0,1)
			];
    
});
