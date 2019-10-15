<?php

use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('visitors')->delete();
        
        \DB::table('visitors')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Bishop Isong',
                'arrival_date' => '2019-10-01',
                'car_plate_no' => 'ABU-300-ZT',
                'purpose' => 'Dignissimos est aperiam non.',
                'image' => 'no_image.jpg',
                'status' => '1',
                'time_in' => '2019-10-11 13:41:47',
                'time_out' => NULL,
                'user_id' => 10,
                'home_id' => 7,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Augustine Zechariah Thirdname',
                'arrival_date' => '2019-12-01',
                'car_plate_no' => 'ABK-300-TU',
                'purpose' => 'Dignissimos est aperiam non.',
                'image' => 'no_image.jpg',
                'status' => '1',
                'time_in' => '2019-10-11 13:42:30',
                'time_out' => NULL,
                'user_id' => 10,
                'home_id' => 7,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'OneNameIsAlsoAccepted',
                'arrival_date' => '2020-12-01',
                'car_plate_no' => 'LSK-340-DK',
                'purpose' => 'Dignissimos est aperiam non.',
                'image' => 'no_image.jpg',
                'status' => '1',
                'time_in' => '2019-10-11 13:43:17',
                'time_out' => NULL,
                'user_id' => 10,
                'home_id' => 7,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'CarPlateNoCanBeNull',
                'arrival_date' => '2020-12-01',
                'car_plate_no' => NULL,
                'purpose' => 'Dignissimos est aperiam non.',
                'image' => 'no_image.jpg',
                'status' => '1',
                'time_in' => '2019-10-11 13:47:49',
                'time_out' => NULL,
                'user_id' => 10,
                'home_id' => 7,
            ),
        ));
        
        
    }
}