<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //https://laravel.com/docs/5.7/seeding

        // primero actualizamos el autoload de composer
        // composer dump_autoload
        // Corre con: php artisan migrate:refresh --seed

        // $this->call(UsersTableSeeder::class);

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
        DB::table('users')->insert([
            // empleado
            'tipo_user' => 1,
            // activo
            'estado' => 0,
            'nombre' => 'Iginio',
            'apellidos' => 'iginio_moreno',
            'email' => 'iginio_moreno@gmail.com',
            'telefono' => 9711345235,
            'domicilio' => 'calle calle col los pinos',
            'puesto' => 'Asesor tecnico',
            'rfc' => 'KLGSGDNVGALD',
            'password' => bcrypt('iginioiginio1'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            // tecnico
            'tipo_user' => 2,
            // activo
            'estado' => 0,
            'nombre' => 'Dario',
            'apellidos' => 'Moreno Diaz',
            'email' => 'dario_pena@gmail.com',
            'telefono' => 971436233,
            'domicilio' => 'colon de los ramirez #121 col centro',
            'puesto' => 'cobranza',
            'rfc' => 'GGDS25SDD',
            'password' => bcrypt('dariodario1'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            // empleado
            'tipo_user' => 1,
            // activo
            'estado' => 0,
            'nombre' => 'Bronco',
            'apellidos' => 'Salvador Carmona',
            'email' => 'bronco_salvador@gmail.com',
            'telefono' => 9347345125,
            'domicilio' => 'avenida de los broncos col centro',
            'puesto' => 'asesor sap',
            'rfc' => '34634DADDDGASS2',
            'password' => bcrypt('broncobronco1'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            // tecnico
            'tipo_user' => 2,
            // activo
            'estado' => 0,
            'nombre' => 'Eusebio',
            'apellidos' => 'Nicolas Garza',
            'email' => 'eusebio22@hotmail.com',
            'telefono' => 97234455645,
            'domicilio' => 'colonia de los olivos #22 valparaiso',
            'puesto' => 'soporte sap',
            'rfc' => 'SSD34LBLLBL',
            'password' => bcrypt('eusebioeusebio1'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // Insertando areas
        DB::table('areas')->insert([
            'clave_area' => 'SDSNSDL4221',
            'nombre' => 'Recursos Humanos',
            'estado' => 1
        ]);

        DB::table('areas')->insert([
            'clave_area' => '221EDDSS676',
            'nombre' => 'Informática',
            'estado' => 1
        ]);

        // Insertando  tipo de incidentes
        DB::table('tipo_incidentes')->insert([
            'nombre' => 'NAS',
            'descripcion' => 'Furners stutter from yellow fevers like scurvy cockroachs.',
            'estado' => 1
        ]);

        DB::table('tipo_incidentes')->insert([
            'nombre' => 'SAI',
            'descripcion' => 'After shredding the raspberries, flavor nachos, meatballs and joghurt with it in a wok.',
            'estado' => 1
        ]);

        DB::table('tipo_incidentes')->insert([
            'nombre' => 'SOFTWARE',
            'descripcion' => 'Booda-hood believes when you follow with bliss.',
            'estado' => 1
        ]);

        DB::table('incidentes')->insert([
            'empleadoId' => 3,
            'etiquetado' => 0,
            'tipo' => 3,
            'area' => 1,
            'prioridad' => 0,
            'caso' => 'Fallo en sistema 32',
            'diagnostico' => 'el fallo es debido a un suministro alterado de electricidad',
            'solucion' => 'se cambia el controlador de la red electrica',
            'descripcion_fallo' => 'fallo en caja de reserva y central, caja11.',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('incidentes')->insert([
            'empleadoId' => 3,
            'etiquetado' => 0,
            'tipo' => 3,
            'area' => 1,
            'prioridad' => 1,
            'caso' => 'el sistema de finanzas esta lento',
            'diagnostico' => 'parece que el server está saturado',
            'solucion' => 'se reparte el trabajo entre dos servidores',
            'descripcion_fallo' => 'Hay una baja de la velocidad de facturación a partir de la hora pico todos los dias. A tal grado de dejar en cola varios procesos.',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('incidentes')->insert([
            'empleadoId' => 2,
            'etiquetado' => 0,
            'tipo' => 3,
            'area' => 2,
            'prioridad' => 2,
            'caso' => 'Algo no anda bien con el sistema de rastreo de unidades',
            'diagnostico' => 'el sistema de rastreo esta tardando en cargar debido a una sobrecarga del cache del almacenamiento de sensores',
            'solucion' => 'Se vacia el cache',
            'descripcion_fallo' => 'el cache esta ocupando un importante espacio en la ram lo que esta obtaculizando el sistema.',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('incidentes')->insert([
            'empleadoId' => 4,
            'etiquetado' => 0,
            'tipo' => 2,
            'area' => 2,
            'prioridad' => 0,
            'caso' => 'Las señales satelitales llegan con mucho ruido',
            'diagnostico' => 'Las lineas 4 y 5 del satelite estan caidas',
            'solucion' => 'se activan las lineas y se coloca un reactivador en el sitio',
            'descripcion_fallo' => 'Las lineas tienen un mes sin cumplir correctamente su función por lo que no está llegando completa la señal de los sensores de Ingeteam.',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
