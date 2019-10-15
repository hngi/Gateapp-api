<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messages')->delete();
        
        \DB::table('messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'estate_id' => 4,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'hello there',
                'read' => 0,
                'created_at' => '2019-10-11 17:36:25',
                'updated_at' => '2019-10-11 17:36:25',
            ),
            1 => 
            array (
                'id' => 2,
                'estate_id' => 2,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'hello there',
                'read' => 0,
                'created_at' => '2019-10-13 13:35:06',
                'updated_at' => '2019-10-13 13:35:06',
            ),
            2 => 
            array (
                'id' => 3,
                'estate_id' => 3,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'How do you do',
                'read' => 0,
                'created_at' => '2019-10-13 13:39:41',
                'updated_at' => '2019-10-13 13:39:41',
            ),
            3 => 
            array (
                'id' => 4,
                'estate_id' => 3,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'How do you do?',
                'read' => 0,
                'created_at' => '2019-10-13 14:08:49',
                'updated_at' => '2019-10-13 14:08:49',
            ),
            4 => 
            array (
                'id' => 5,
                'estate_id' => 2,
                'sender_id' => 2,
                'receiver_id' => 14,
                'message' => 'How do you do?',
                'read' => 0,
                'created_at' => '2019-10-13 16:04:09',
                'updated_at' => '2019-10-13 16:04:09',
            ),
            5 => 
            array (
                'id' => 6,
                'estate_id' => 1,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'How do you do?',
                'read' => 0,
                'created_at' => '2019-10-13 18:47:16',
                'updated_at' => '2019-10-13 18:47:16',
            ),
            6 => 
            array (
                'id' => 7,
                'estate_id' => 3,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'Hello?',
                'read' => 0,
                'created_at' => '2019-10-13 18:48:26',
                'updated_at' => '2019-10-13 18:48:26',
            ),
            7 => 
            array (
                'id' => 8,
                'estate_id' => 1,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'Gate pass?',
                'read' => 0,
                'created_at' => '2019-10-13 19:11:30',
                'updated_at' => '2019-10-13 19:11:30',
            ),
            8 => 
            array (
                'id' => 9,
                'estate_id' => 5,
                'sender_id' => 10,
                'receiver_id' => 14,
                'message' => 'Hello?',
                'read' => 0,
                'created_at' => '2019-10-14 12:56:34',
                'updated_at' => '2019-10-14 12:56:34',
            ),
        ));
        
        
    }
}