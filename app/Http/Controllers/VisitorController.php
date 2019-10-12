<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use JWTAuth;

class VisitorController extends Controller
{

    /**
     * @var string $user
     * @access protected
     */
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
        // $this->user = JWTAuth::parseToken()->authenticate();
    }

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
    	// if there was no pagination set by the query,
    	// limit the response to 15 data set
    	$visitors = Visitor::paginate($per_page);

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
        $res = $this->user->visitors()->find($id);

        // output an error if the id is not found
        if (!$res) {
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
    	// validate the posted data
    	$this->validate($request, [
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'arrival_date' => 'required|date_format:Y-m-d',
            'car_plate_no' => 'string|nullable',
            'purpose' => 'required|string',
            'image' => 'string|nullable',
            'status' => 'required|string',
            'home_id' => 'required|integer',    		
    	]);

        $visitor = new Visitor();

        $visitor->name = $request->name;
        $visitor->arrival_date = $request->arrival_date;
        $visitor->car_plate_no = $request->car_plate_no;
        $visitor->purpose = $request->purpose;
        $visitor->image = $request->image ? $request->image : 'no_image.jpg';
        $visitor->status = $request->status;
        $visitor->user_id = $this->user->id;
        $visitor->home_id = $request->home_id;

		// add new visitor
        if ($this->user->visitors()->save($visitor)) {
        	// send response
            return response()->json([
                'error'   => false,
                'visitor' => $visitor,
                'status'  => true,
                'message' => 'Visitor successfully added',
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'status' => false,
                'message' => 'Sorry, visitor could not be added'
            ], 500);
        }    	
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
        $visitor = $this->user->visitors()->find($id);
   
        // output an error if the id is not found
        if (!$visitor) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

        $updated = $visitor->fill($request->except(['token']));

        // bootstrap the carbon support package
        $time = Carbon::now();
        $time_in = $time->format('Y-m-d H:i:s');

        // fetch the necesssary data needed to be updated for the visitor
        $data = [
            'name' => Visitor::useit($request->name, $visitor->name),
            'arrival_date' => Visitor::useit($request->arrival_date, $visitor->arrival_date),
            'car_plate_no' => Visitor::useit($request->car_plate_no, $visitor->car_plate_no),
            'purpose' => Visitor::useit($request->purpose, $visitor->purpose),
            'image' => Visitor::useit($request->image, $visitor->image),
            'status' => Visitor::useit($request->status, $visitor->status),
            'time_in' => Visitor::useit($request->time_in, $visitor->time_in),
            'time_out' => Visitor::useit($request->time_out, $visitor->time_out),
            'user_id' => Visitor::useit($request->user_id, $visitor->user_id),
            'home_id' => Visitor::useit($request->home_id, $visitor->home_id),
        ];

        // validate the posted data
        $validator = Validator::make($data, [
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
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

        // check if the data is valid
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
            return response()->json([
                'error'   => true,
                'status'  => false,
                'message' => 'Sorry, visitor\'s could not be updated'
            ], 200);
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
		$visitor = $this->user->visitors()->find($id);

        // output an error if the id is not found
        if (!$visitor) {
            return response()->json(['message' => 'Record not found!'], 400);
        }
		
		// delete the requested visitor and send a response
		if($visitor->delete()) {
            return response()->json([
                'error' => false,
                'status' => true,
                'message' => 'Visitor information has been deleted successfully',
            ], 200);
		} else {
            return response()->json([
                'error' => true,
                'status' => false,
                'message' => 'Visitor could not be deleted',
            ], 500);
		}
	}
}


