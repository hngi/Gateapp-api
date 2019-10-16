<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ResidentGateman;
use App\User;
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
            // Confirm that the Id entered is for a gateman 
            $gateman = User::find($id); 
            
            if($gateman->role == 2){

                    DB::commit();
                    $msg['message'] = 'Your Invite has been sent to Gateman';
                    $msg['residentGateman'] = $residentGateman;
                    $msg['status'] = 201;
                    return $msg;
                    
            }else {
                $msg['message'] = 'That user is not a gateman please try again';
                $msg['status'] = 404;
                return $msg;      
            }
           

        }catch(\Exception $e) {
            //if an error occurs and the relationship is not established 
            DB::rollBack();

            $msg['message'] = "Error: Could not invite gateman, please try again!";
            $msg['user'] = null;
            $msg['hint'] = $e->getMessage();
            $msg['status'] = 501;
            return $msg;
        }


    }

    //Resident can manage Gate man 
    public function store() {
        


    }

    // Resident can delete his gateman
    public function destroy($id) {
        
        $gateman = ResidentGateman::where('gateman_id',  $id)
                             ->where('user_id', $this->user->id)->first();
        if ($gateman){
            $gateman->delete();

            // Success message
            $res['message']    = "Gateman deleted";
            return response()->json($res, 200);  

        }else{
            $res['message']    = "Records do not exist";
            return response()->json($res, 404);  
        }
       

    }


}
