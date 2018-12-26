<?php

use Illuminate\Database\Seeder;

class IncidenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
