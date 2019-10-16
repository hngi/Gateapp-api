<?php

namespace App\Http\Controllers;

use App\Gateman;
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
