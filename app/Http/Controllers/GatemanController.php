<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\User;
use App\Visitor;
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
    	$requests = Gateman::where('gateman_id', $this->user->id)->get();

    	$users = [];

    	// get the resident's name and id requesting for the gateman
		foreach ($requests as $request) {
	    	$user = User::select('id', 'name')->where('id', $request->user_id)->get();

			array_push($users, $user);
		}

        return response()->json([
        	'requests' => $requests->count(),
        	'residents' => $users,
        	'status' => true
        ], 200);

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
        // get user id
        $user_id = Gateman::where([
        ['gateman_id', $this->user->id],
        ['request_status', 1],
        ])->pluck('user_id');
        // get visitors with the user_id
        $visitors = Visitor::whereIn('user_id', $user_id)->with('user')
        ->get();
        // list out visitors details
        if ($visitors){
            return response()->json([
              'visitors' => $visitors->count(),
              'visitor' => $visitors,
              'status' => true
            ], 200);
        }
        else {
          return response()->json([
              'message' => 'No Visitors found',
              'status' => false
            ], 404);
        }
    }
    
    /**
     * 
     */
    public function admitVisitors()
    {

    }
}