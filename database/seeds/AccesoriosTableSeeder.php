<?php

use Illuminate\Database\Seeder;

class AccesoriosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Accesorio::class, 10)->create();
    }
}
