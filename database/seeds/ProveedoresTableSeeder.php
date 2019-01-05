<?php

use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creaando 20 ejemplos de proveedor
        factory(App\Proveedor::class, 20)->create();
    }
}
