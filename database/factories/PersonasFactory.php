<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Personas;
use Faker\Generator as Faker;

$factory->define(Personas::class, function (Faker $faker) {
    return [
        'rfc' => strtoupper(Str::random(13)),
        'curp' => strtoupper(Str::random(18)),
        'nombre' => $faker->firstname,
        'primer_ap' =>  $faker->firstname,
        'segundo_ap' =>  $faker->firstname,
        'telefono' => $faker->phoneNumber,
        'email' =>  $faker->unique()->safeEmail,
        'num_empleado' => Str::random(5),
        'genero' => 'M',
        'created_at' => now(),
        'activo' => true,
        'id_status_persona' => 'A'
    ];
});