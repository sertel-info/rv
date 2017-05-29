<?php
//namespace Database\factories\Assinantes;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Linhas\DadosAutenticacaoLinhas::class, function (Faker\Generator $faker) {

    return ['login_ata'=>$faker->randomNumber(4),
    		'usuario'=>$faker->randomNumber(5),
    		'senha'=>$faker->password(),
    		'ip'=>$faker->ipv4(),
    		'porta'=>$faker->randomNumber(4)
    		];
    
});
