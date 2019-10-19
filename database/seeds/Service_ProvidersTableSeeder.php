<?php

use Illuminate\Database\Seeder;

class Service_ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Service_Provider::class, 10)->create();
    }
}
