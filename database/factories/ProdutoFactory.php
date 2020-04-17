<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->sentence,
        'informacoes' => $faker->paragraph(5, true),
        'preco'=> $faker->randomFloat(2, 1, 10),
        'slug' => $faker->slug,
    ];
});
