<?php

$factory->define(\App\Models\Linhas\DadosFacilidadesLinhas::class, function (Faker\Generator $faker) {

	$cadeado_pessoal = rand(0,1);
	$siga_me = rand(0,1);
	$caixa_postal = rand(0, 1);

    return [    "gravacao"=>rand(0,1),
				"cadeado_pessoal"=>$cadeado_pessoal,
				"siga_me"=>$siga_me,
				"caixa_postal"=>$caixa_postal,
				"cx_postal_pw"=> $caixa_postal ? $faker->password() : null,
				"cx_postal_email"=> $caixa_postal ? $faker->email() : null,
				"cadeado_pin"=>$cadeado_pessoal ? $faker->randomNumber(5) : null,
				"num_siga_me"=>$siga_me ? $faker->randomNumber(9) : null
				];

});