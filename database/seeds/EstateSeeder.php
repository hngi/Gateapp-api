<?php

use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    public function run()
    {
        factory(Estate::class, 10)->create();
    }
}
