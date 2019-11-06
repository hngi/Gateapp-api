<?php
namespace App\Http\Controllers;

use App\Estate;
use App\Http\Controllers\Controller;
use App\Notifications\GatemanInvitationNotification;
use App\ResidentGateman;
use App\Service_Provider;
use App\User;
use App\Home;
use App\Http\Resources\Resident as ResidentResource;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
           $check_exist = ResidentGateman::where('user_id',  $this->user->id)->where('gateman_id', $id)->first();
           if(!$check_exist){
               $residentGateman = ResidentGateman::firstOrCreate([
                    'user_id'     => $this->user->id, //login user id
                    'gateman_id'  =>   $id
                ]);
                // Confirm that the Id entered is for a gateman
                $gateman = User::find($id);
                $resident = User::find($this->user->id);
                if($gateman->role == 2){
                        // Send the gateman a notifications
                        $gateman->notify(new GatemanInvitationNotification($resident, $gateman));
                        DB::commit();
                        $msg['status'] = true;
                        $msg['message'] = 'Your Invite has been sent to Gateman';
                        $msg['residentGateman'] = $residentGateman;
                        return response()->json($msg, 200);
                }else {
                    $msg['status'] = false;
                    $msg['message'] = 'That user is not a gateman please try again';
                    return response()->json($msg, 404);
                }
           }else {
                $msg['status'] = false;
                if($check_exist->request_status == 0){
                    $msg['message'] = "An invitation has already been sent and has not been attended to yet!";
                } elseif($check_exist->request_status == 1) {
                    $msg['message'] = "Invitation already accepted!";
                }
                return response()->json($msg, 405);
           }
        }catch(\Exception $e) {
            //if an error occurs and the relationship is not established
            DB::rollBack();
            $msg['message'] = "Error: Could not invite gateman, please try again!";
            $msg['user'] = null;
            $msg['hint'] = $e->getMessage();
            return response()->json($msg, 501);
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
        //$gatemen = User::where('phone', 'LIKE', "%{$phone}%")->where('role', "=", "2")->get();
        $gatemen = User::where([
            ['phone', $phone],
            ['role', "2"],
            ])->first();
        if (!($gatemen)){
            //Error Handling
            $res['Error']    = "No Gateman found with this phone number";
            return response()->json($res, 404);
        } else
             $homeResident = Home::Where("user_id", $this->user->id)->pluck("estate_id");
             $homeGateman = Home::Where("user_id", $gatemen->id)->pluck("estate_id");
             if($homeGateman != $homeResident) {
                $res['Error']    = "Gateman and Resident are not in the same estate";
                return response()->json($res, 404);
             }
             return response()->json($gatemen);
      }
    }
    public function searchGatemanByName($name)
    {
       if (Auth::check()) {
        //$this->validateName($request);
        //$gatemen = User::where('name', 'LIKE', "%{$name}%")->where('role', "=", "2")->get();
        $gatemen = User::where('name', '=', "%{$name}%")->where('role', "=", "2")->get();
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
    public function viewPendingGateman (){
        $residentGateman = ResidentGateman::where('user_id', $this->user->id)
            ->where('request_status', 0)
            ->get('gateman_id');
        $gateman = User::find($residentGateman);
        if($gateman){
            $msg["data"] = $gateman;
            return response()->json($msg, 200);
        }else{
            $msg['message'] = 'No Gateman added';
            $msg['status'] = 404;
            return response()->json($msg, 404);
        }
    }
    public function viewAcceptedGateman (){
        $residentGateman = ResidentGateman::where('user_id', $this->user->id)
            ->where('request_status', 1)
            ->get('gateman_id');
        $gateman = User::find($residentGateman);
        if($gateman){
            $msg["data"] = $gateman;
            return response()->json($msg, 200);
        }else{
            $msg['message'] = 'No Gateman added';
            $msg['status'] = 404;
            return response()->json($msg, 404);
        }
    }

    //Estate Admin Search Residents in an estate by name
    public function searchEstateResidentByName ($name)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;
            $res = array();
            
            if ($role === "0" || $role === "3" ) {
                $estateAdmin = Home::with('user_id')->pluck('estate_id');
                $estateresidents = Home::with('user_id')->pluck('estate_id');
                

                if ($estateAdmin == $estateresidents) {

                    $estateresidents = User::where('name', 'LIKE', "%{$name}%")->where('user_type', '=', 'resident')->get();
                    if (!$estateresidents){
                        //Error Handling
                        $res['status']  = false;
                        $res['message'] = 'No Estates found';
                        return response()->json($res, 404);

                    }else{
                        $res['status']  = true;
                        $res['message'] = 'Resident(s) Found (By Name)';
                        $res['residents']  = $estateresidents;
                    return response()->json($res, 200);
                    }
                } else {
                    $res['status']  = false;
                    $res['message'] = 'You are not logged in as an admin of this estate';
                    return response()->json($res, 404);
                }               
            
            } else {
                $res['status'] = 401;
                $res['message'] = "You must login as an admin or superadmin";
            }
        }else {
            $res['status'] = 401;
            $res['message'] = "You are not logged in.";
        }
    }


    //Super Admin Search Residents by name system wide
    public function searchResidentByName ($name)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;
            
            if ($role === "0") {


                $allresidents = User::where('name', 'LIKE', "%{$name}%")->where('user_type', '=', 'resident')->get();
                if (!$allresidents){
                    //Error Handling
                    $res['status']  = false;
                    $res['message'] = 'No Resident found with that name';
                    return response()->json($res, 404);

                }else{
                    $res['status']  = true;
                    $res['message'] = 'Resident(s) Found (By Name)';
                    $res['residents']  = $allresidents;
                    return response()->json($res, 200);
                }                
                
            } else {
                $res['status'] = 401;
                $res['message'] = "You must login as a superadmin";
            }
        } else {
            $res['status'] = 401;
            $res['message'] = "You are not logged in.";
        }
    }

    
    //Fetch all residents in the system

    public function residents()
    {
        //Query users db table seeking for users with user_type = resident
        //Join the result set with homes db table based on homes.user_id
        //and get the estate_id of the users
        //Query estate db table for the estate name
        $residents = User::join('homes', 'homes.user_id', 'users.id')
            ->join('estates', 'estates.id', 'homes.estate_id')
            ->where('users.user_type', 'resident')
            ->get(['users.name', 'users.phone', 'homes.user_id', 'homes.id as home_id', 'users.user_type', 'estates.estate_name']);

        return response()->json([
            'count' => $residents->count(),
            'residents' => $residents,
            'status' => true
        ], 200);
    }
    
    //Fetch residents in a particular estate
    public function estateResidents($id)
    {
     try {
          $residents = [];
          $homes = Home::all();
          foreach($homes as $home)
          {
           $eid = $home->estate_id;
           if($eid == $id)
           {
            $new = array();
            $user = User::find($home->user_id);
            if($user->user_type == "resident")
            {
             array_push($new, $user);
             array_push($residents, $new);
            }
           }
          }
         
          $res["status_code"] = 200;
          $res["message"] = "Success!";
          $res["residents"] = $residents;
         
          return response()->json($res, $res["status_code"]);
         }
          catch (\Exception $e)
         {
          $res["status_code"] = 501;
          $res["message"] = "Failed!";
          $res["error"] = $e->getMessage();
              
          return response()->json($res, $res["status_code"]);
         }
    }
   

}
