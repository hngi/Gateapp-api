<?php

namespace App\Http\Controllers\EstateBills\Residents;

use App\Http\Controllers\Controller;
use App\Estate;

class GetAllBills extends Controller
{
    /**
     * Gets authenticated user's data
     *
     * @return App\User
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

	/**
	 * Gets all billable items for the user's estate
	 * 
     * @return \Illuminate\Http\Response
	 */
	public function __invoke(Estate $estate)
	{
		// Get user's estate db resource identifier
        $user_estate = $this->user->home->estate_id;

        // Verify the existence of such an estate
        $estate = $estate->find($user_estate);

        // Check if such an estate exists
        // You never can tell what may happen as bad users may spoof estate id
        if(!$estate)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Estate not found'
            ], 404);
        }

        // Get all estate bills for the user's estate
        $estate_bills = $estate->billableItems;

        // Send response
        return response()->json([
        	'count'   => $estate_bills->count(),
            'status'  => true,
            'data'	  => $estate
        ], 200);
	}
}
