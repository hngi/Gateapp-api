<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\Estate;
use App\Notifications\GatemanAcceptanceNotification;
use App\Notifications\VisitorArrivalNotification;
use App\User;
use App\Home;
use App\Visitor;
use Exception;
use App\Visitor_History;
use App\Http\Resources\Visitor as VisitorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use App\Http\Controllers\ImageController;
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
	    	// get the resident's details requesting for the gateman together with the request id
	    	$user = User::join('resident_gateman', 'resident_gateman.user_id', 'users.id')
	    		->where('resident_gateman.request_status', 0)
	    		->where('resident_gateman.gateman_id', $this->user->id)
	    		->get(['users.*', 'resident_gateman.id as request_id', 'resident_gateman.gateman_id']);

	        return response()->json([
	        	'requests' => $requests->count(),
	        	'residents' => $user,
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
	        // ensure that only the right gateman can accept the request
	        if ($gateman->gateman_id != $gateman_id) {
	            return response()->json(['status' => false, 'message' => 'Access denied'], 401);
	        }

        	// check if the request has not been accepted
        	$request = $gateman->where('id', $id)
        		->where('gateman_id', $gateman_id)
        		->where('request_status', 0)
        		->exists();

        	// update the request
        	if ($request) {
        		$gateman->request_status = 1;

        		if ($gateman->save()) {
                        // Send the resident a notification informing them
                        //  of the acceptance
                        $resident = User::find($gateman['user_id']);
                        $user = User::find($gateman_id);
        		        $resident->notify(new GatemanAcceptanceNotification($resident, $user));
			        return response()->json([
			        	'message' => 'The request has been accepted successfully',
			        	'status' => true,
			        	'resident_gateman' => $gateman
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
	        // ensure that only the right gateman can reject the request
	        if ($gateman->gateman_id != $gateman_id) {
	            return response()->json(['status' => false, 'message' => 'Access denied'], 401);
	        }

        	// check if the request has not been accepted
        	$request = $gateman->where('id', $id)
        		->where('gateman_id', $gateman_id)
        		->where('request_status', 0)
        		->exists();

        	// update the request
        	if ($request) {
	        	// reject the request
        		if ($gateman->destroy($id)) {
			        return response()->json([
			        	'message' => 'The request has been rejected successfully',
			        	'status' => true,
			        	'resident_gateman' => $gateman
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
        $visitors = Visitor::whereIn('user_id', $user_id)
        	->with('user')
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

    public function admitVisitor(Request $request)
    {
        $visitor = Visitor::where('qr_code', $request->input('qr_code'))->first();

        if ($visitor){
            //Error Handling
            $resident_id = $visitor->user_id;
            $visitor_id = $visitor->id;

            // Check that Gateman works for user
            $residentGateman = Gateman::where([
                ['gateman_id', $this->user->id],
                ['user_id', $resident_id],
                ['request_status', 1],
            ])->first();

            if ($residentGateman){
                 Visitor::where('id', $visitor_id)->update(['time_in' => NOW()]);

                // $avisitor = Visitor::where('id', $resident)->update(['time_in' => NOW(), 'status' => 1]);

                $visitor = Visitor::where('id', $visitor_id)->with('user')->get();
                $res ['Message'] = "Visitor Has been checked in succesfully";
                $res ['Visitor details'] = $visitor;
            	return response()->json($res, 202);
            }
            else {
                $res['Error'] = "Permission Denied!- You can not admit this resident's visitors";
            	return response()->json($res, 403);
            }
        }
        else {
            $res['Error'] = $request->input('qr_code'). " This QR code does not exist";
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
        //$resident = User::find($user_id);
        $resident = User::whereIn('id',$user_id)->with('visitors')->withCount('visitors')->get();

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
        $visitor = Visitor::where('qr_code', $request->input('qr_code'))->where('time_in', '!=', null)->first();

        if ($visitor){
            //Error Handling
            $resident_id = $visitor->user_id;
            $visitor_id = $visitor->id;

            // Check that Gateman works for user
            $residentGateman = Gateman::where([
                ['gateman_id', $this->user->id],
                ['user_id', $resident_id],
                ['request_status', 1],
			])->first();

            if ($residentGateman){
                $visitor = Visitor::where('id', $visitor_id)
                            ->update(['time_out' => NOW(), 'status' => 0, 'qr_code' => null]);
                $avisitor = Visitor::where('id', $visitor_id);

                $history = new Visitor_History;

                $history->visitor_id = $avisitor->value('id');
                $history->user_id = $avisitor->value('user_id');
                $history->visit_date = $avisitor->value('time_out');
                $history->save();

                $visitor = Visitor::where('id', $visitor_id)->with('user')->get();
                $res ['Message'] = "Visitor Has been checked out succesfully";
                $res ['Visitor details'] = $visitor;
                $resident_notifiable = User::find($resident_id);
                $gateman_notifiable  = User::find($this->user->id);
                $resident_notifiable->notify(new VisitorArrivalNotification($resident_notifiable, $gateman_notifiable, $visitor));
            	return response()->json($res, 202);
            }
            else {
            	$res['Error'] = "Permission Denied!-You cannot check this resident's visitors out";
            	return response()->json($res, 403);
            }
        }
        else {
            $res['Error'] = $request->input('qr_code'). " This QR code does not exist or this user has not been clocked in";
            return response()->json($res, 404);
        }
    }

    /**
     * Adds a gateman to an estate
     *
     * @return \Illuminate\Http\Response
     */
    public function addEstateGateman(
        $id,
        Home $home,
        User $new_user,
        Request $request
    ){
        // Verifies that the logged-in user is assigned to the requested estate
        $user_estate = Home::whereUserIdAndEstateId($this->user->id, $id)->first();

        if (is_null($user_estate)) {
            return response()->json([
                'status' => false,
                'message'=> "Unauthorized!",
            ], 401);
        }
        else
        {
            // Validate the posted data
            $this->validate($request, [
                'name'  => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
                'phone' => ['required', 'string'],
            ]);

            DB::beginTransaction();

            try{
                // Create user
                $new_user->name  = $request->name;
                $new_user->phone = $request->phone;
                $new_user->role  = 2;
                $new_user->user_type = 'gateman';
                $new_user->save();

                // Register gateman's estate
                $home->user_id   = $new_user->id;
                $home->estate_id = $id;
                $home->save();

                // transaction was successful
                DB::commit();

                $result = [
                    'name'      => $new_user->name,
                    'phone'     => $new_user->phone,
                    'user_id'   => $new_user->id,
                    'home_id'   => $home->id,
                    'estate_id' => (int) $home->estate_id
                ];

                // send response
                return response()->json([
                    'status'  => true,
                    'message' => 'The gateman was successfully added',
                    'result'  => $result
                ], 200);
            } catch(Exception $e) {
                // transaction was not successful
                DB::rollBack();

                return response()->json([
                    'status'    => false,
                    'message'   => 'Error, the gateman could not be added',
                    'hint'      => $e->getMessage()
                ], 501);
            }
        }
    }

    /**
     * Gets a single gateman or all gatemen details for an estate
     *
     * @return \Illuminate\Http\Response
     */
    public function estateGatemen(
        $estate_id,
        $id = null,
        Request $request
    ){
        // Verifies that the logged-in user is assigned to the requested estate
        $user_estate = Home::whereUserIdAndEstateId($this->user->id, $estate_id)->first();

        if (is_null($user_estate)) {
            return response()->json([
                'status' => false,
                'message'=> "Unauthorized!",
            ], 401);
        }
        else
        {
            // Check if requests is for a single gateman
            if (is_null($id)) {
                // Request is for all gatemen associated with the estate
                // Get all gatemen users type associated with the estate
                $gatemen = User::join('homes', 'homes.user_id', 'users.id')
                    ->where('users.user_type', 'gateman')
                    ->where('homes.estate_id', $estate_id)
                    ->get();

                return response()->json([
                    'count' => $gatemen->count(),
                    'status' => true,
                    'gatemen' => $gatemen,
                ], 200);
            }
            else
            {
                // Request is for a single gateman associated with the estate
                // Get the gateman if only he is truly a gateman and is associated with the estate
                $gateman = User::join('homes', 'homes.user_id', 'users.id')
                    ->where('users.id', $id)
                    ->where('homes.estate_id', $estate_id)
                    ->first([
                        'users.name', 'users.username', 'users.phone',
                        'users.email', 'users.image', 'users.duty_time',
                        'homes.id as home_id', 'users.id as user_id'
                    ]);

                if($gateman) {
                    return response()->json([
                        'status' => true,
                        'gateman' => $gateman
                    ], 200);
                }
                else {
                    return response()->json([
                        'status' => false,
                        'message' => "We cannot verify the user with id: {$id} as a gateman assigned to ". Estate::find($estate_id)->estate_name,
                    ], 406);
                }
            }
        }
    }

    /**
     * Updates a gateman details for an estate
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEstateGateman(
        $estate_id,
        $id,
        Request $request
    ){
        // Verifies that the logged-in user is assigned to the requested estate
        $user_estate = Home::whereUserIdAndEstateId($this->user->id, $estate_id)->first();

        if (is_null($user_estate)) {
            return response()->json([
                'status' => false,
                'message'=> "Unauthorized!",
            ], 401);
        }
        else
        {
            $gateman = User::join('homes', 'homes.user_id', 'users.id')
                ->where('users.id', $id)
                ->where('users.user_type', 'gateman')
                ->where('homes.estate_id', $estate_id)
                ->get();

            // Check if such user exists as a gateman for the estate
            if (!$gateman->isEmpty()) {
                // Validate the posted data
                $this->validate($request, [
                    'name'  => ['regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
                    'phone' => ['string'],
                ]);

                $updatedUser = User::find($id);

                // Update user's details
                $updatedUser->name  = $request->name ?? $updatedUser->name;
                $updatedUser->phone = $request->phone ?? $updatedUser->phone;
                $updatedUser->duty_time = $request->duty_time ?? $updatedUser->duty_time;

                // Save the update
                $updatedUser->save();

                // Return response
                return response()->json([
                    'status'  => true,
                    'message' => "The gateman's record has successfully been updated",
                    'result'  => $updatedUser
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => "We cannot verify the user with id: {$id} as a gateman assigned to ". Estate::find($estate_id)->estate_name,
                ], 406);
            }
        }
    }

    /**
     * Deletes a gateman record for an estate
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteEstateGateman(
        $estate_id,
        $id,
        Request $request
    ){
        // Verifies that the logged-in user is assigned to the requested estate
        $user_estate = Home::whereUserIdAndEstateId($this->user->id, $estate_id)->first();

        if (is_null($user_estate)) {
            return response()->json([
                'status' => false,
                'message'=> "Unauthorized!",
            ], 401);
        }
        else
        {
            $gateman = User::join('homes', 'homes.user_id', 'users.id')
                ->where('users.id', $id)
                ->where('users.user_type', 'gateman')
                ->where('homes.estate_id', $estate_id)
                ->get();

            // Check if such user exists as a gateman for the estate
            if (!$gateman->isEmpty()) {
                // Delete the record
                $update = User::find($id)->delete();

                if ($update) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Gateman has been deleted successfully!',
                    ], 200);
                }
                else
                {
                    // if delete action fails, send a response
                    return response()->json([
                        'status' => false,
                        'message' => 'Sorry, this gateman could not be deleted at the moment!',
                    ], 501);
                }
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => "We cannot verify the user with id: {$id} as a gateman assigned to ". Estate::find($estate_id)->estate_name,
                ], 406);
            }
        }
    }
}
