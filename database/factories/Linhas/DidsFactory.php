<?php

$factory->define(\App\Models\Linhas\Dids::class, function (Faker\Generator $faker) {

    return [ "usuario_did"=>$faker->username(),
				"senha_did"=>$faker->password(),
				"ip_did"=>$faker->ipv4(),
				"extensao_did"=>$faker->randomNumber(8)
				];

});