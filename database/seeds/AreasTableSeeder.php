<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
    }
}
