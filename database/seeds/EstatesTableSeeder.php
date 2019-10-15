<?php

use Illuminate\Database\Seeder;

class EstatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estates')->delete();
        
        \DB::table('estates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'estate_name' => 'Peace Viila',
                'city' => 'Abuja',
                'country' => 'Nigeria',
                'created_at' => '2019-10-10 15:41:25',
                'updated_at' => '2019-10-10 15:41:25',
            ),
            1 => 
            array (
                'id' => 2,
                'estate_name' => 'Banana Estate',
                'city' => 'Lagos',
                'country' => 'NIgeria',
                'created_at' => '2019-10-10 15:41:57',
                'updated_at' => '2019-10-10 15:41:57',
            ),
            2 => 
            array (
                'id' => 4,
                'estate_name' => 'Lokogoma',
                'city' => 'Abuja',
                'country' => 'Nigeria',
                'created_at' => '2019-10-10 15:48:13',
                'updated_at' => '2019-10-10 15:48:13',
            ),
            3 => 
            array (
                'id' => 5,
                'estate_name' => 'Riverside',
                'city' => 'Abuja',
                'country' => 'Nigeria',
                'created_at' => '2019-10-11 12:17:16',
                'updated_at' => '2019-10-11 12:17:16',
            ),
            4 => 
            array (
                'id' => 8,
                'estate_name' => 'Citec Estate',
                'city' => 'Abuja',
                'country' => 'Nigeria',
                'created_at' => '2019-10-13 16:41:59',
                'updated_at' => '2019-10-13 16:41:59',
            ),
        ));
        
        
    }
}