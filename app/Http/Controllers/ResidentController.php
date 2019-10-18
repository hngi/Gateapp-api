<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ResidentGateman;
use App\User;
use App\Http\Resources\Resident as ResidentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


    public function searchGatemanByPhone($phone)
    {
       if (Auth::check()) {
        //$this->validatePhone($request);
        $gatemen = User::where('phone', 'LIKE', "%{$phone}%")->where('role', "=", "2")->get();
        
        
        if ($gatemen ->isEmpty()){
            //Error Handling
            $res['Error']    = "No Gateman found with this phone number";
            return response()->json($res, 404);  
             
        } else
             $allgatemen = ResidentResource::collection($gatemen); //Use Resource to format Output 
             return response()->json($allgatemen); 
      } 
    }

    public function searchGatemanByName($name)
    {
       if (Auth::check()) {
        //$this->validateName($request);
        $gatemen = User::where('name', 'LIKE', "%{$name}%")
        ->where('role', "=", "2")->get();
        if ($gatemen ->isEmpty()){
            //Error Handling
            $res['Error']    = "No Gateman found with this name";
            return response()->json($res, 404);  
             
        } else
             $allgatemen = ResidentResource::collection($gatemen); //Use Resource to format Output 
             return response()->json($allgatemen); 
      } 
    }

    public function validatePhone(Request $request){
        $rules = [
            'phone' => 'required',
            //'device_id' => 'required',
        ];
        $messages = [
            'phone' => ':attribute is required',
            //'device_id' => 'device_id is required',
        ];
        $this->validate($request, $rules, $messages);
    }

    public function validateName(Request $request){
        $rules = [
            'name' => 'required',
            //'device_id' => 'required',
        ];
        $messages = [
            'name' => ':attribute is required',
            'device_id' => 'device_id is required',
        ];
        $this->validate($request, $rules, $messages);

    }

    public function pendingInvitation($id){
        DB::beginTransaction();

        try{
            $pendingInvitation = ResidentGateman::find([
                "user_id" => $id,
                "request_status" => 0
            ]);

            $res['message'] = 'My Pending Invitations';
            $res['data']    = $pendingInvitation;

            DB::commit();
            $res['status'] = 201;
            return $res;

        }catch(\Exception $e) {
            //if an error occurs the relationship is not established
            DB::rollBack();

            $res['message'] = "Error: Could not get pending gateman invitation";
            $res['user'] = null;
            $res['hint'] = $e->getMessage();
            $res['status'] = 501;
            return $res;
        }
    }


    public function acceptedInvitation($id){
        DB::beginTransaction();

        try{
            $pendingInvitation = ResidentGateman::find([
                "user_id" => $id,
                "request_status" => 1
            ]);

            $res['message'] = 'My Pending Invitations';
            $res['data']    = $pendingInvitation;

            DB::commit();
            $res['status'] = 201;
            return $res;

        }catch(\Exception $e) {
            //if an error occurs the relationship is not established
            DB::rollBack();

            $res['message'] = "Error: Could not get pending gateman invitation";
            $res['user'] = null;
            $res['hint'] = $e->getMessage();
            $res['status'] = 501;
            return $res;
        }
    }


}
