<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CatTipoContrato;
use Faker\Generator as Faker;

$factory->define(CatTipoContrato::class, function (Faker $faker) {
    return [
        'clave_tipo_contrato' => Str::random(1),
        'tipo_contrato' => Str::random(5),
        'activo' => true
    ];
});
