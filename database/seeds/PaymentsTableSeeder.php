<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payments')->delete();
        
        \DB::table('payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 10,
                'home_id' => 1,
                'amount' => 3000.0,
                'created_at' => '2019-10-11 17:16:38',
                'updated_at' => '2019-10-11 17:16:38',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 36,
                'home_id' => 1,
                'amount' => 3000.0,
                'created_at' => '2019-10-11 17:22:57',
                'updated_at' => '2019-10-11 17:22:57',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 10,
                'home_id' => 2,
                'amount' => 4500.0,
                'created_at' => '2019-10-11 18:23:54',
                'updated_at' => '2019-10-11 18:23:54',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 36,
                'home_id' => 2,
                'amount' => 4500.0,
                'created_at' => '2019-10-11 18:31:44',
                'updated_at' => '2019-10-11 18:31:44',
            ),
        ));
        
        
    }
}