<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

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
	 * Get the residents' details, requesting for the gateman
	 */
    public function residentRequest()
    {
    	$requests = Gateman::where([
    		['gateman_id', $this->user->id],
    		['request_status', 0]
    	])->get();

    	// return response if there are no requests or invitations
		if (empty($requests) || ($requests->count() == 0)) {
	        return response()->json([
	        	'total' => 0,
	        	'status' => true,
	        	'message' => 'There are no requests or invitations'
	        ], 200);
		}

    	// return response if there are invitations
		else {
	    	$users = [];

	    	// get the resident's details and id requesting for the gateman
			foreach ($requests as $request) {
		    	$user = User::join('resident_gateman', 'resident_gateman.user_id', '=', 'users.id')
		    		->where('users.id', '=', $request->user_id)
		    		->where('resident_gateman.request_status', 0)
		    		->where('resident_gateman.gateman_id', $this->user->id)
		    		->limit(4)
		    		->get(['users.*', 'resident_gateman.id as request_id', 'resident_gateman.*']);

				array_push($users, $user);
			}

	        return response()->json([
	        	'requests' => $requests->count(),
	        	'residents' => $users,
	        	'status' => true
	        ], 200);
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
