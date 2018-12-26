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
        'telefono' => $faker->numberBetween($min=1287654321, $max=2147483645),
        'domicilio' => $faker->address,
        'puesto' => $faker->jobTitle,
        'rfc' => $faker->swiftBicNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // password: secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Incidente::class, function(Faker $faker)
{
    // retorna datos aleatorios para la creacion de un incidente en el seeder
    return [
        // desde 2(el admin no) hasta
        // solo los primeros 8 usuarios para poder aceptarlos y no tener problemas con los
        // incidentes
        'empleadoId'=> $faker->numberBetween($min=2, $max=8),
        'etiquetado' => 0,
        // tipo de incidente
        'tipo' => $faker->numberBetween($min=1, $max=3),
        // depende del area de igual forma
        'area' => $faker->numberBetween($min=1, $max=2),
        // baja, media, alta
        'prioridad' => $faker->numberBetween($min=0, $max=2),
        'caso' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'diagnostico' => $faker->text($max=150),
        'solucion' => $faker->text($max=150),
        'descripcion_fallo' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        // insertando una fecha
        //'created_at' => $faker->dateTime($format="Y-m-d H:i:s", $max = 'now')
        'created_at' => date("Y-m-d H:i:s")
    ];
});