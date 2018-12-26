<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //desactivamos temporalmente la protección de asignación de
        // los modelos a seedear, así podemos seedear todas las propiedades del
        //modelo
        Model::unguard();
        //https://laravel.com/docs/5.7/seeding

        // primero actualizamos el autoload de composer
        // composer dump_autoload
        // Corre con: php artisan migrate:refresh --seed

        // seeding para testing de la database
        DB::table('users')->insert([
            // administrador
            'tipo_user' => 0,
            // activo
            'estado' => 1,
            'nombre' => 'Eduardo',
            'apellidos' => 'Rasgado Ruiz',
            'email' => 'eduardo.rasgado@hotmail.com',
            'telefono' => 9711334455,
            'domicilio' => 'calle #22 col centro',
            'puesto' => 'Programador',
            'rfc' => 'KLNVGALD',
            'password' => bcrypt('gabagabahey'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // llamando a los seeders
        $this->call(EmpleadosTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(TipoIncidenteTableSeeder::class);
        $this->call(IncidenteTableSeeder::class);

        Model::reguard();
    }
}
