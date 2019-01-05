<?php

use Illuminate\Database\Seeder;

class ActivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Activo::class, 20)->create();
    }
}
