<?php

use Illuminate\Database\Seeder;

class TipoIncidenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
