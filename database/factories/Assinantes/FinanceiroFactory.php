<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Assinantes\DadosFinanceiroAssinante::class, function (Faker\Generator $faker) {

    return [
       "dias_bloqueio"=>rand(1,20),
       "dia_vencimento"=>rand(1,31),
       "limite_credito"=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
       "alerta_saldo"=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
       "espaco_disco"=>rand(1024, 1024*1024)
    ];
});
