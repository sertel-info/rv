<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Assinantes\DadosFacilidadesAssinante::class, function (Faker\Generator $faker) {

    return [
        "acesso_ramais"=>rand(0,1),
        "portal_voz"=>rand(0,1),
        "sala_conferencia"=>rand(0,1),
        "fila_atendimento"=>rand(0,1),
        "ura_atendimento"=>rand(0,1),
        "envio_sms"=>rand(0,1)
    ];

});
