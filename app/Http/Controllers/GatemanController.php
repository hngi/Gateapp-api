<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

use App\GatemanGetAllResidentInvitation;
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


        $residents = GatemanGetAllResidentInvitation::where('request_status', 1);

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
    public function response()
    {

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
