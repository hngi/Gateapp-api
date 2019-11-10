<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuperAdminPassword;

class SuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super-admin:create {name : Name of the super admin} {email : Email of the super admin} {password : create secure password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a super admin in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name     = $this->argument('name');
        $email    = $this->argument('email');
        $password = $this->argument('password');

        try{
            DB::table('users')->insert(
                ['name' => $name, 'email' => $email, 'password' => Hash::make($password)]
            );    

            Mail::to($email)->send(new SuperAdminPassword($name, $password));
            $this->info('Super Admin Created Successfully');

        }catch(\Exception $e) {
            $this->info('An Error occured: '. $e->getMessage());
        }
    }
}
