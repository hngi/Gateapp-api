<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VisitorController extends Controller
{
	/**
	 * Get all visitor
	 *
	 * @param  int $page number of pages for pagination 
	 * @return JSON
	 */
    public function index(Request $request)
    {
    	// get number of visitors to be fetched
    	$per_page = $request->query('per_page');

    	// return the requested number of visitors.
    	// if there was no requested number of visitors,
    	// the default, 15 visitors data, are sent
    	$visitors = Visitor::paginate($per_page);

        if ($visitors['total'] == 0) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

        // send response with the visitors' details
        return response()->json([
        	'error'  => false,
        	'data'   => $visitors,
        	'status' => true,
        ], 200);
    }

	/**
	 * Get a single visitor
	 *
	 * @param  int $id the visitor id
	 * @return JSON
	 */
    public function show($id)
    {
    	// retrieve the visitor's detials with the id
        $res = Visitor::find($id);

        // output an error if the id is not found
        if (is_null($res)) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

        // send response
        return response()->json([
            'error'   => false,
            'visitor' => $res,
            'status'  => true
        ], 200);
    }

	/**
	 * Create a new visitor
	 *
	 * @param  obj $request an instance of the Request::class
	 * @return JSON
	 */
    public function store(Request $request)
    {
    	// get the posted data
    	$data = [
            'visitor_name' => $request->visitor_name,
            'arrival_date' => $request->arrival_date,
            'car_plate_no' => $request->car_plate_no,
            'purpose' 	   => $request->purpose,
            'image' 	   => $request->image,
            'status' 	   => $request->status,
            'user_id' 	   => $request->user_id,
            'home_id' 	   => $request->home_id,
    	];

    	// validate the posted data
    	$validator = \Validator::make($data, [
            'visitor_name' => 'required|string',
            'arrival_date' => 'required|date_format:Y-m-d',
            'car_plate_no' => 'string|nullable',
            'purpose' => 'required|string',
            'image' => 'string|nullable',
            'status' => 'required|string',
            'user_id' => 'required|integer',
            'home_id' => 'required|integer',    		
    	]);

		// checkes if the data is valid
		if($validator->fails()) {
			return response()->json($validator->errors());
		}

    	// create new visitor with validated data
    	$visitor = Visitor::create($data);
    	
    	// send response
        return response()->json([
            'error'   => false,
            'visitor' => $visitor,
            'status'  => true,
            'message' => 'Visitor successfully added',
        ], 200);	
    }

	/**
	 * Update a single visitor
	 *
	 * @param  obj $request an instance of Request::class
	 * @param  int $id      the visitor id
	 * @return JSON
	 */
	public function update(Request $request, $id)
	{
    	// gets the visitor's record from the database
		$visitor = Visitor::find($id);

        // output an error if the id is not found
        if (is_null($visitor)) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

    	// bootstrap the carbon support package
    	$time = Carbon::now();
    	$time_in = $time->format('Y-m-d H:i:s');

		// fetch the necesssary data need to be updated for the visitor
    	$data = [
            'visitor_name' => Visitor::useit($request->visitor_name, $visitor->visitor_name),
            'arrival_date' => Visitor::useit($request->arrival_date, $visitor->arrival_date),
            'car_plate_no' => Visitor::useit($request->car_plate_no, $visitor->car_plate_no),
            'purpose' 	   => Visitor::useit($request->purpose, $visitor->purpose),
            'image' 	   => Visitor::useit($request->image, $visitor->image),
            'status' 	   => Visitor::useit($request->status, $visitor->status),
            'time_in' 	   => Visitor::useit($request->time_in, $visitor->time_in),
            'time_out' 	   => Visitor::useit($request->time_out, $visitor->time_out),
            'user_id' 	   => Visitor::useit($request->user_id, $visitor->user_id),
            'home_id' 	   => Visitor::useit($request->home_id, $visitor->home_id),
    	];

    	// validate the posted data
    	$validator = \Validator::make($data, [
            'visitor_name' => 'string',
            'arrival_date' => 'date_format:Y-m-d',
            'car_plate_no' => 'string|nullable',
            'purpose' => 'string',
            'image' => 'string|nullable',
            'status' => 'string',
            'time_in' => 'date_format:"Y-m-d H:i:s"',
            'time_out' => 'date_format:Y-m-d H:i:s|nullable',
            'user_id' => 'integer',
            'home_id' => 'integer',  		
    	]);

		// checkes if the data is valid
		if($validator->fails()) {
			return response()->json($validator->errors());
		}

        // update the visitor's requested data
		$success = $visitor->update($data);

		// send out response
		if ($success) {
	        return response()->json([
	            'error'   => false,
	            'visitor' => $visitor,
	            'status'  => true,
	            'message' => "Visitor's information updated successfully"
	        ], 200);	
		} else {
			$resp['error']   = true;
			$resp['status']  = false;
			$resp['message'] = 'We could not update the information now, please try again';

			return response()->json($resp);
		}
	}

	/**
	 * Delete a single visitor
	 *
	 * @param  int $id the visitor id
	 * @return JSON
	 */
	public function destroy($id)
	{
    	// retrieve the visitor's detials with the id
		$visitor = Visitor::find($id);

        // output an error if the id is not found
        if (is_null($visitor)) {
            return response()->json(['message' => 'Record not found!'], 404);
        }
		
		// delete the requested visitor
		$success = $visitor->delete();

		// send a response
		if($success) {
			$resp['error']    = false;
			$resp['status']   = true;
			$resp['message']  = "Visitor information has been deleted successfully";
		} else {
			$resp['error']    = true;
			$resp['status']   = false;
			$resp['message']  = "We could not delete this visitor";
		}
		
		return response()->json($resp);
	}

}