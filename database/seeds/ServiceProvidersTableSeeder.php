<?php

use Illuminate\Database\Seeder;

class ServiceProvidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_providers')->delete();
        
        \DB::table('service_providers')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Joshua',
                'phone' => '08135875974',
                'description' => 'Chef',
                'image' => 'img.jpg',
                'estate_id' => 1,
                'created_at' => '2019-10-11 17:58:38',
                'updated_at' => '2019-10-11 17:58:38',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Richard',
                'phone' => '08134875974',
                'description' => 'Cleaner',
                'image' => 'img.jpg',
                'estate_id' => 8,
                'created_at' => '2019-10-13 18:27:46',
                'updated_at' => '2019-10-13 18:27:46',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Richard',
                'phone' => '08134875974',
                'description' => 'Cleaner',
                'image' => 'img.jpg',
                'estate_id' => 8,
                'created_at' => '2019-10-13 19:55:31',
                'updated_at' => '2019-10-13 19:55:31',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'Richard1',
                'phone' => '08134875974',
                'description' => 'Cleaner',
                'image' => 'img.jpg',
                'estate_id' => 8,
                'created_at' => '2019-10-13 19:56:10',
                'updated_at' => '2019-10-13 19:56:10',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'Richard',
                'phone' => '08134875974',
                'description' => 'Cleaner',
                'image' => 'img.jpg',
                'estate_id' => 8,
                'created_at' => '2019-10-15 05:26:08',
                'updated_at' => '2019-10-15 05:26:08',
            ),
        ));
        
        
    }
}