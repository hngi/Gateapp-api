<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\User;
use App\Visitor;
use App\Http\Resources\Visitor as VisitorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
     * Method for gateman to accept resident's request
     */
    public function accept($id)
    {
    	// set the gateman id
    	$gateman_id = $this->user->id;

    	// retrieve the request
        $gateman = Gateman::find($id);

		// check for the existence of the request on the db
        if (!$gateman) {
            return response()->json(['status' => false, 'message' => 'Request not found!'], 404);
        } else {
        	// check if the request has not been accepted
        	$request = $gateman->where('gateman_id', $gateman_id)
        		->where('request_status', 0)
        		->exists();
        	
        	// update the request
        	if ($request) {
        		$gateman->request_status = 1;

        		if ($gateman->save()) {
			        return response()->json([
			        	'message' => 'The request has been accepted successfully',
			        	'status' => true
			        ], 202);
        		} else {
			        return response()->json([
			        	'message' => 'The request could not be accepted at the moment',
			        	'status' => false
			        ], 500);
				}
        	} else {
		        return response()->json([
		        	'message' => 'This request has already been accepted',
		        	'status' => true
		        ], 200);
        	}
        }
    }

    /**
     * Method for gateman to reject resident's request
     */
    public function reject($id)
    {
    	// set the gateman id
    	$gateman_id = $this->user->id;

    	// retrieve the request
        $gateman = Gateman::find($id);

		// check for the existence of the request on the db
        if (!$gateman) {
            return response()->json(['status' => false, 'message' => 'Request not found!'], 404);
        } else {
        	// check if the request has not been accepted
        	$request = $gateman->where('gateman_id', $gateman_id)
        		->where('request_status', 0)
        		->exists();
        	
        	// update the request
        	if ($request) {
        		$gateman->request_status = 1;

        		if ($gateman->destroy($id)) {
			        return response()->json([
			        	'message' => 'The request has been rejected successfully',
			        	'status' => true
			        ], 202);
        		} else {
			        return response()->json([
			        	'message' => 'The request could not be rejected at the moment',
			        	'status' => false
			        ], 500);
				}
        	} else {
		        return response()->json([
		        	'message' => 'This request has already been accepted',
		        	'status' => true
		        ], 200);
        	}
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

    
    public function admitVisitor(Request $request)
    {
        
            $resident = Visitor::where('qr_code', $request->input('qr_code'))->first();
            if ($resident){
                //Error Handling
                $resident = $resident->id;
                // Check that Gateman works for user
                $residentGateman = Gateman::where([
                    ['gateman_id', $this->user->id],
                    ['user_id', $resident],
                    ['request_status', 1],
                    ])->first();
                if ($residentGateman){
                    $avisitor = Visitor::where('id', $resident)->update(['time_in' => NOW()]);
                $visitor = Visitor::where('id', $resident)->with('user')->get();
                return response()->json($visitor); 
                return response()->json($visitor, 202);

                }else {
                $res['Error']    = " Unauthorized- Access Denied!";
                return response()->json($res, 403);  
                }
                 
            } else{
                $res['Error']    = $request->input('qr_code'). " This QR code does not exist";
                return response()->json($res, 404);  

            } 
    }


    public function viewResidents()
    {
        // get user id
        $user_id = Gateman::where([
        ['gateman_id', $this->user->id],
        ['request_status', 1],
        ])->pluck('user_id');
        // get visitors with the user_id
        $resident = User::find($user_id);
        // list out visitors details
        if ($resident){
            return response()->json([
              'residents' => $resident->count(),
              'resident' => $resident,
              'status' => true
            ], 200);
        }
        else {
          return response()->json([
              'message' => 'No Residents found',
              'status' => false
            ], 404);
        }
    }
    
        


    public function visitor_out(Request $request)
    {
        $resident = Visitor::where('qr_code', $request->input('qr_code'))->first();
            if ($resident){
                //Error Handling
                $resident = $resident->id;
                // Check that Gateman works for user
                $residentGateman = Gateman::where([
                    ['gateman_id', $this->user->id],
                    ['user_id', $resident],
                    ['request_status', 1],
                    ])->first();
                if ($residentGateman){
                    $avisitor = Visitor::where('id', $resident)->update(['time_in' => NOW()]);
                $visitor = Visitor::where('id', $resident)->with('user')->get();
                return response()->json($visitor); 
                return response()->json($visitor, 202);

                }else {
                $res['Error']    = " Unauthorized - Access Denied!";
                return response()->json($res, 403);  
                } 
                 
            } else{
                $res['Error']    = $request->input('qr_code'). " This QR code does not exist";
                return response()->json($res, 404);  

            }   
    }
}