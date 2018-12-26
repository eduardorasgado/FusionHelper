<?php

use Illuminate\Database\Seeder;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
    }
}
