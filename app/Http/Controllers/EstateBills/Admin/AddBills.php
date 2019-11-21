<?php

namespace App\Http\Controllers\EstateBills\Admin;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\EstateBills;
use App\Estate;
use App\User;

class AddBills extends Controller
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
	 * Add a new billable item
	 * 
     * @return \Illuminate\Http\Response
	 */
	public function __invoke($estate_id, Request $request, EstateBills $bills)
	{
		// Verify the admin user's association with the estate
        $estates_administered = $this->user->home()->pluck('estate_id')->toArray();

		if (!in_array($estate_id, $estates_administered)) {
            return response()->json([
                'status'  => false,
                'message' => 'You are not authorised to administrate this estate'
            ], 403);
		}

        $estate_name = Estate::whereId($estate_id)->first('estate_name');

		// Validate posted data
        $this->validate($request, [
            'item'        => ['required', 'string'],
            'icon_link'   => ['required', 'string'],
            'base_amount' => ['required', 'between:0,99.99'],
        ]);

        // Pass in required validated data for record entry
        $validated = $request->only('item', 'icon_link', 'base_amount');

        // Reference and fill the estate id
        $validated['estates_id'] = (int) $estate_id;

        // Save new entry to record
        try 
        {
	        $saved = $bills->create($validated);

            return response()->json([
                'status'  => true,
                'data'	  => $saved,
                'message' => "Item: {$saved->item} has been added as a billable item for {$estate_name['estate_name']}"
            ], 200);
        }
        catch(QueryException $e)
        {
            return response()->json([
                'status'  => false,
                'message' => "Item: {$request->name} could not be added as a billable item for {$estate_name['estate_name']}. Try again!",
                'hint'	  => $e->getMessage()
            ], 501);
        }
	}
}

