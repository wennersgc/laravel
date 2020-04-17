<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Loja::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->sentence,
        'fone' => $faker->phoneNumber,
        'celular' => $faker->phoneNumber,
        'slug' => $faker->slug,
    ];
});
