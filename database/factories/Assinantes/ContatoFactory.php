<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Assinantes\DadosContatoAssinante::class, function (Faker\Generator $faker) {

    return[
            "cep"=>$faker->randomNumber(8),
            "endereco"=>$faker->address(),
            "complemento"=>$faker->streetSuffix(),
            "bairro"=>$faker->cityPrefix(),
            "cidade"=>$faker->city(),
            "estado"=>$faker->state(),
            "pais"=>$faker->country(),
            "email"=>$faker->email(),
            "site"=>$faker->domainName(),
            "telefone"=>$faker->tollFreePhoneNumber(),
            "fax"=>$faker->tollFreePhoneNumber(),
            "celular"=>$faker->tollFreePhoneNumber()
         ];
});
