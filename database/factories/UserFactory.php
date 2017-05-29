<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\User::class, function (Faker\Generator $faker) {

    return [
        "name"=>$faker->username(),
        "password"=>$faker->password(),
        "role"=>0,
        "email"=>$faker->email()
    ];

});