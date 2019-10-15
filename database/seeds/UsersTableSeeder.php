<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 10,
                'first_name' => 'David',
                'last_name' => 'Resident',
                'email' => 'junipreach2017@gmail.com',
                'email_verified_at' => '2019-10-10 09:27:56',
                'password' => '$2y$10$5fTYzZi0gJyNUeAYEtBIsemecjsBAb0.iA1YJN.WO4Gm.73PQqOAK',
                'phone' => '07067589834',
                'image' => 'no_image.jpg',
                'verifycode' => 'OngVzX',
                'role' => '1',
                'remember_token' => NULL,
                'created_at' => '2019-10-10 09:22:06',
                'updated_at' => '2019-10-15 05:36:32',
            ),
            1 => 
            array (
                'id' => 13,
                'first_name' => 'Test User',
                'last_name' => 'Admin',
                'email' => 'e_fadairo@yahoo.com',
                'email_verified_at' => '2019-10-10 12:00:00',
                'password' => '$2y$10$pXyozGN/ov2MXNZWsGpuuOmNrxPwfAkRqGmHYz0MOTd5a/GWzmzwC',
                'phone' => '07088556688',
                'image' => 'no_image.jpg',
                'verifycode' => 'dNP6PC',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-10 11:39:21',
                'updated_at' => '2019-10-10 11:39:21',
            ),
            2 => 
            array (
                'id' => 30,
                'first_name' => 'Veronica',
                'last_name' => 'Emiola',
                'email' => 'vtomilola@gmail.com',
                'email_verified_at' => '2019-10-10 00:00:00',
                'password' => '$2y$10$G5QTNZrGTeI0k18teDIa/eydoEqVuH1ZIeTag/ZpQ2mNv5HRcIxuO',
                'phone' => '08053726116',
                'image' => 'no_image.jpg',
                'verifycode' => 'xpHkb6',
                'role' => '1',
                'remember_token' => NULL,
                'created_at' => '2019-10-10 15:58:07',
                'updated_at' => '2019-10-10 15:58:07',
            ),
            3 => 
            array (
                'id' => 36,
                'first_name' => 'Dev',
                'last_name' => 'Joshua',
                'email' => 'joshua.moshood@gmail.com',
                'email_verified_at' => '2019-10-10 09:27:56',
                'password' => '$2y$10$lFxiDcC4zTik/jNjGFhuH.OD5X1PBYTsY5tm94oKEPCSXehxd0xIS',
                'phone' => '08135875974',
                'image' => 'no_image.jpg',
                'verifycode' => 'Gb9uGD',
                'role' => '1',
                'remember_token' => NULL,
                'created_at' => '2019-10-11 07:12:47',
                'updated_at' => '2019-10-11 07:12:47',
            ),
            4 => 
            array (
                'id' => 38,
                'first_name' => 'junicodefire',
                'last_name' => 'Admin',
                'email' => 'juniworld2017@gmail.com',
                'email_verified_at' => '2019-10-10 09:27:56',
                'password' => '$2y$10$xyvdAuFBkuF46bqFOOqbfOriTyoXLFrvADnYgapLHoFS2AuSZ.fjK',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => 'mmmCaq',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-11 09:11:07',
                'updated_at' => '2019-10-11 09:11:07',
            ),
            5 => 
            array (
                'id' => 45,
                'first_name' => 'tochukwu',
                'last_name' => 'ojinaka',
                'email' => 'ojinakatochukwu@gmail.com',
                'email_verified_at' => '2019-10-13 17:02:43',
                'password' => '$2y$10$C5O9zCo1ayilp1lsVPnSIev.nBsbeLeecpN3VflTflxmMrf0UhzEK',
                'phone' => '08146318705',
                'image' => 'no_image.jpg',
                'verifycode' => '5f0ea9',
                'role' => '1',
                'remember_token' => NULL,
                'created_at' => '2019-10-13 16:59:17',
                'updated_at' => '2019-10-13 17:02:43',
            ),
            6 => 
            array (
                'id' => 61,
                'first_name' => 'junicodefire',
                'last_name' => 'Gateman',
                'email' => 'junicodefire@gmail.com',
                'email_verified_at' => '2019-10-13 17:48:37',
                'password' => '$2y$10$n9ZWHCqHf4X8hbxm5RfJ0.T3esZYz8rbY9sbvTz0OhERFbaOSkZu6',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => '622f62',
                'role' => '2',
                'remember_token' => NULL,
                'created_at' => '2019-10-13 17:45:55',
                'updated_at' => '2019-10-13 17:48:37',
            ),
            7 => 
            array (
                'id' => 62,
                'first_name' => 'Admin',
                'last_name' => 'Two',
                'email' => 'gate.api.admin@hi2.in',
                'email_verified_at' => NULL,
                'password' => '$2y$10$SRC4Z/Ls7SnUoQrT8IMmP.KYHpCXBv8ySdMUfR6C4cRkcrJwvDIDi',
                'phone' => '07001111111',
                'image' => 'no_image.jpg',
                'verifycode' => '731jG8',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-13 17:46:39',
                'updated_at' => '2019-10-13 17:46:39',
            ),
            8 => 
            array (
                'id' => 63,
                'first_name' => 'TEST',
                'last_name' => 'Gateman',
                'email' => 'Mawhizzle@gmail.com',
                'email_verified_at' => '2019-10-13 17:49:04',
                'password' => '$2y$10$f5JJcrCGZFMFn50KVtJmI.ptGlXTqDtlTnk6RDY7xqspq.FwHo7.i',
                'phone' => '08038287791',
                'image' => 'no_image.jpg',
                'verifycode' => 'a15850',
                'role' => '2',
                'remember_token' => NULL,
                'created_at' => '2019-10-13 17:47:34',
                'updated_at' => '2019-10-13 17:49:04',
            ),
            9 => 
            array (
                'id' => 64,
                'first_name' => 'junicodefire',
                'last_name' => 'Admin',
                'email' => 'juniworld201@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6CYMsWTLRLPMkiJK4fD3DOkR5boEAUyKdNGgnSAyAYJYSt.BeChy.',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => 'yquiOt',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-13 19:09:10',
                'updated_at' => '2019-10-13 19:09:10',
            ),
            10 => 
            array (
                'id' => 65,
                'first_name' => 'junicodefire',
                'last_name' => 'Admin',
                'email' => 'juniworld2017@fgmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$di/esMErQHx24/apQJsTB.xX94dvjCoxJryd9J6qA8CqVSL1Ogg1y',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => '4KEerh',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-14 12:45:44',
                'updated_at' => '2019-10-14 12:45:44',
            ),
            11 => 
            array (
                'id' => 66,
                'first_name' => 'junicodefire',
                'last_name' => 'Admin',
                'email' => 'tobifolajin@gmail.com',
                'email_verified_at' => '2019-10-14 12:51:15',
                'password' => '$2y$10$BU6tQ8/bXB6yTCC/6gYgUOFwzm6orvUHurKJ8WG5iiTxf6CNAiWgi',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => '142013',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-14 12:49:49',
                'updated_at' => '2019-10-14 12:51:15',
            ),
            12 => 
            array (
                'id' => 67,
                'first_name' => 'Jude',
                'last_name' => 'Jonathan',
                'email' => 'jonathanjude27@gmail.com',
                'email_verified_at' => '2019-10-14 13:35:21',
                'password' => '$2y$10$aF4eX99ytRudi/shW8y1POePsoOainR/nH8JuMpt7GOiLBip6qca.',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => 'lkS0Bi',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-14 13:28:21',
                'updated_at' => '2019-10-14 13:59:54',
            ),
            13 => 
            array (
                'id' => 68,
                'first_name' => 'Jude',
                'last_name' => 'Jonathan',
                'email' => 'jude@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$73jLwxxSzFjHRiPlOWseVeMz1MxHy79deHreTBYX5IZBm0QuR7z92',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => 'H7o04G',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-14 13:50:01',
                'updated_at' => '2019-10-14 13:50:01',
            ),
            14 => 
            array (
                'id' => 69,
                'first_name' => 'Charles',
                'last_name' => 'Essien',
                'email' => 'charlespheonix@gmail.com',
                'email_verified_at' => '2019-10-15 05:43:42',
                'password' => '$2y$10$FFOd2ovWKWKGtW8AMqMwgeNpZSdZdARzjc4XvG7zg89lBMayaZZeO',
                'phone' => '08108482427',
                'image' => 'no_image.jpg',
                'verifycode' => '4cc885',
                'role' => '1',
                'remember_token' => NULL,
                'created_at' => '2019-10-15 05:43:05',
                'updated_at' => '2019-10-15 05:43:42',
            ),
            15 => 
            array (
                'id' => 70,
                'first_name' => 'Charles',
                'last_name' => 'Essien',
                'email' => 'carlyitservices@gmail.com',
                'email_verified_at' => '2019-10-15 05:50:00',
                'password' => '$2y$10$mPMYYmMk/lYIpbrHoubK1eagYZqDEk69Nmy4O/j01wMTWEA51hXaq',
                'phone' => '07060959269',
                'image' => 'no_image.jpg',
                'verifycode' => 'bdd0d7',
                'role' => '0',
                'remember_token' => NULL,
                'created_at' => '2019-10-15 05:49:27',
                'updated_at' => '2019-10-15 05:50:00',
            ),
        ));
        
        
    }
}