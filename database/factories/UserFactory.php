<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        // tipo entre 1 y 2
        'tipo_user' => $faker->numberBetween($min=1, $max=2),
        'estado' => $faker->numberBetween($min=0, $max=1),
        'nombre' => $faker->firstName,
        'apellidos' => "$faker->lastName $faker->lastName",
        'email' => $faker->unique()->safeEmail,
        'telefono' => $faker->isbn10,
        'domicilio' => $faker->address,
        'puesto' => $faker->jobTitle,
        'rfc' => $faker->swiftBicNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

//$factory->define(App\Incidente::class, )