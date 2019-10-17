<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\User;
use App\Visitor;
use App\Http\Resources\Visitor as VisitorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check()) {
            $visitor = Visitor::where('qr_code', '=', "{$request->input('qr_code')}")
            ->get();
            if ($visitor ->isEmpty()){
                //Error Handling
                $res['Error']    = $request->input('qr_code'). " This QR code does not exist";
                return response()->json($res, 404);  
                 
            } else
                 //$visitor = VisitorResource::collection($visitor);
                 dd($visitor);
                 $user_id = $visitor->Visitor->user_id;
                 $visitor = Visitor::whereIn('user_id', $user_id)->with('user');
                 $visitor = VisitorResource::collection($visitor); //Use Resource to format Output 
                 Visitor::where('qr_code', '=', "{$request->input('qr_code')}")
                 ->update(['time_in' => CURRENT_TIMESTAMP]);
                 return response()->json($visitor); 
          }
    }

    public function visitor_out(Request $request)
    {
        if (Auth::check()) {
            $visitor = Visitor::where('qr_code', '=', "{$request->input('qr_code')}")
            ->get();
            if ($visitor ->isEmpty()){
                //Error Handling
                $res['Error']    = "This QR code does not exist";
                return response()->json($res, 404);  
                 
            } else
                 $visitor = Visitor::whereIn('user_id', $user_id)->with('user');
                 $visitor = VisitorResource::collection($visitor); //Use Resource to format Output 
                 Visitor::where('qr_code', '=', "{$request->input('qr_code')}")
                 ->update(['time_out' => CURRENT_TIMESTAMP]);
                 return response()->json($visitor); 
          }
    }
}