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
        $this->call(UsersTableSeeder::class);
        $this->call(EstatesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ServiceProvidersTableSeeder::class);
        $this->call(HomesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(VisitorsTableSeeder::class);
    }
}
