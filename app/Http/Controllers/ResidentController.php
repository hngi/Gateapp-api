<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ResidentGateman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
    /**
     * @var string $user
     * @access protected
     */
    protected $user;

    public function __construct()
    {
    	$this->user = auth()->user();
    }
    //Search for Gateman by phone number 




    //Search for Gateman by name


    
    

     // Add a gateman by a resident 
     public function addGateman($id) {
        
        DB::beginTransaction();

        try{
           $residentGateman = ResidentGateman::firstOrCreate([
                'user_id'     => $this->user->id, //login user id
                'gateman_id'  =>   $id
            ]);

            $msg['message'] = 'Your Invite has been sent to Gateman';
            $msg['residentGateman']    = $residentGateman;
          
                DB::commit();
                $msg['status'] = 201;
                return $msg;

        }catch(\Exception $e) {
            //if an error occurs the relationship is not established 
            DB::rollBack();

            $msg['message'] = "Error: Could not invite gateman, please try again!";
            $msg['user'] = null;
            $msg['hint'] = $e->getMessage();
            $msg['status'] = 501;
            return $msg;
        }


    }


}
