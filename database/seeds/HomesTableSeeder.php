<?php

use Illuminate\Database\Seeder;

class HomesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('homes')->delete();
        
        \DB::table('homes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 10,
                'estate_id' => 2,
                'house_no' => 23,
                'qr_code' => NULL,
                'created_at' => '2019-10-09 00:00:00',
                'updated_at' => '2019-10-11 17:08:02',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 36,
                'estate_id' => 1,
                'house_no' => 12,
                'qr_code' => 'Bcode',
                'created_at' => '2019-10-12 17:50:19',
                'updated_at' => '2019-10-12 17:50:19',
            ),
        ));
        
        
    }
}