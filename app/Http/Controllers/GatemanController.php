<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GatemanController extends Controller
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

	/**
	 * Gets all residents request for the gateman
	 */
    public function residentRequest()
    {
    	// ensure user has the gateman role
        if ($this->user->role != '2') {
	        return response()->json([
	        	'status' => false,
	        	'message' => 'User is not a registered gateman',
	        ], 200);
        }


        $residents = Gateman::where('request_status', 1);

        if (!$residents) {

            $res['message'] = "Invitations not found";
            $res['payment'] = null;
            $res['status'] = 404;
            return response()->json($res, $res['status']);
        }else{
            $stach_details = [];
            foreach ($residents as $resident) {
                if ((!empty($resident->user_id)) && $this->user->id == $resident->gateman_id)) {
                    $User = User::where('id', $resident->user_id);
                    if ($User) {
                        // user Exist,then push detials
                        array_push($stach_details, $User);
                    }
                }
            }
            //  returning resident users that invited current gateman user
            $res['message'] = "Invitations from residents was found";
            $res['resident_details'] = $stach_details;
            $res['status'] = 200;

            return response()->json($res, $res['status']);
        }


    }

    /**
     * Method to update gateman's response to resident's request
     */
    public function response(Request $request)
    {
        // ensure user has the gateman role
        if ($this->user->role != '2') {
            return response()->json([
                'status' => false,
                'message' => 'User is not a registered gateman',
            ], 200);
        }

        $id =$request->input('invitation_id');
        $status = $request->input('request_status');

        $existence = Gateman::where('id', $id)->exists();

        if($existence) {
            try {
                
                DB::update('update resident_gateman set request_status = ? where id = ? and gateman_id = ?', [$status, $id, $this->user->id]);

                if ($status == 1) {
                    $res['message'] = "Invitation was rejected";
                }elseif ($status == 0) {
                    $res['message'] = "Invitation was accepted";
                }
                
                $res['status'] = true;
                $res['statusCode'] = 200;

                return response()->json($res, $res['statusCode']);
            }catch(\Exception $e) {

                $data['message'] = "Could not handle request, please try again later";
                $msg['hint'] = $e->getMessage();
                return response()->json($data, 501);
            }
        }else{
            $res['message'] = "Invitation not found";
            $res['status'] = false;
            $res['statusCode'] = 501;
            return response()->json($res, $res['statusCode']);
        }
    }

    /**
     * Method to display all visitors of the resident whom
     * the gateman is assigned to 
     */
    public function viewVisitors()
    {

    }

    /**
     * 
     */
    public function admitVisitors()
    {

    }
}
