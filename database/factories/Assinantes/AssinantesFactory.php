<?php
//namespace Database\factories\Assinantes;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Assinantes\Assinantes::class, function (Faker\Generator $faker) {

    return [  
        "nome_fantasia"=>$faker->firstName(),
        "razao_social"=>$faker->firstName(),
        "cnpj"=>$faker->randomNumber(8),
        "inscricao_estadual"=>$faker->randomNumber(8),
        "plano"=>rand(1,3),
        "tipo"=>1,
        "cpf"=>$faker->randomNumber(8),
        "nome"=>$faker->firstName(),
        "sobrenome"=>$faker->lastName(),
        "rg"=>$faker->randomNumber(8),
        "creditos"=>$faker->randomFloat(2, $min = 0, $max = 10)
    ];
});

$factory->state(App\Models\Assinantes\Assinantes::class, 'pessoa_fisica', function ($faker) {
    return [
        'nome_fantasia' => null,
        'razao_social' => null,
        'cnpj' => null,
        'inscricao_estadual' => null,
        'tipo' => 1,
    ];
});


$factory->state(App\Models\Assinantes\Assinantes::class, 'pessoa_juridica', function ($faker) {
    return [
        'cpf' => null,
        'nome' => null,
        'sobrenome' => null,
        'rg' => null,
        'tipo' => 0,
    ];
});
