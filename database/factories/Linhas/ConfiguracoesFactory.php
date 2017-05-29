<?php

$factory->define(\App\Models\Linhas\DadosConfiguracoesLinhas::class, function (Faker\Generator $faker) {

    return [
			"callerid"=>$faker->e164PhoneNumber(),
			"envio_dtmf"=>$faker->randomElement(["auto",
												"rfc2833",
												"inband",
												"info"]),
			"ring_falso"=>rand(0,1),
			"nat"=>rand(0,1)
    		];

});