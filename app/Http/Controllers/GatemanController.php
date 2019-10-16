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
