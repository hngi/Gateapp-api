<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\GatemanInvitationNotification;
use App\ResidentGateman;
use App\Service_Provider;
use App\User;
use App\Home;
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


    //Fetch all residents in the system

    public function residents(Request $request){
        $residents = Home::with([
            'user',
            'estates'
        ])->where('users.user_type', 'residents')->get(); 
        if (!$residents){
            $res['status']  = false;
            $res['message'] = 'No resident found';
            return response()->json($res, 404); 
        }else {
            $res['status']  = true;
            $res['message'] = 'Residents in the system';
            $res['residents'] = $residents;
            return response()->json($res, 200);
        }
    }

    //Fetch residents in a particular estate
    public function estateResidents(
        $estate_id,
        $id = null,
        Request $request
    ){
        //Check if the logged-in user is assigned to the requested estate
        $user_estate = Home::whereUserIdAndEstateId($this->user->id, $estate_id)->first();
        
        if (is_null($user_estate)) {
            return response()->json([
                'status' => false,
                'message'=> "Access Denied!",
            ], 401);
        }
        else
        {
            // Check if requests is for one resident
            if (is_null($id)) {
                // Request is for all resident in the estate 
                // Get all resident users type in the estate
                $residents = User::join('homes', 'homes.user_id', 'users.id')
                    ->where('users.user_type', 'resident')
                    ->where('homes.estate_id', $estate_id)
                    ->get();
                return response()->json([
                    'count' => $residents->count(),
                    'status' => true,
                    'residents' => $residents,
                ], 200);
            }
            else
            {
                // Request is for a single resident in the estate
                // Get resident if only if it is a resident in the estate
                $resident = User::join('homes', 'homes.user_id', 'users.id')
                    ->where('users.id', $id)
                    ->where('homes.estate_id', $estate_id)
                    ->first([
                        'users.name', 'users.estate', 'users.phone',
                        'homes.id as home_id', 'users.id as user_id'
                    ]);
                if($resident) {
                    return response()->json([
                        'status' => true,
                        'resident' => $resident
                    ], 200);
                }
                else {
                    return response()->json([
                        'status' => false,
                        'message' => "We cannot verify the user with id: {$id} as a resident user in ". Estate::find($estate_id)->estate_name,
                    ], 406);
                }
            }
        }
    }
}
