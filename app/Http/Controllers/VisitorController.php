<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\QrCodeGenerator;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    }

    /**
     * Gets all visitors for a signed in user
     */
    public function residentVisitor(Request $request)
    {
        $visitors = Visitor::where('user_id', $this->user->id)->get();

        if ($visitors->isEmpty()){
            return response()->json([
                'Message'   => "No Visitors found for this user",
                'status' => false
            ], 404);
        }
        else{
              // send response with the visitors' details
            return response()->json([
                'visitors' => $visitors->count(),
                'visitor'   => $visitors,
            	'status' => true
            ], 200);
        }        
    }

    /**
     * Admin gets all visitors
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
            'visitors' => $visitors,    
        	'status' => true
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
            return response()->json([  'status'  => false, 'message' => 'Record not found!'], 404);
        }

        // send response
        return response()->json([
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
    public function store(Request $request,QrCodeGenerator $qr, ImageController $image)
    {
<<<<<<< HEAD
    	// validate the posted data
    	$this->validate($request, [
=======
        // validate the posted data
        $this->validate($request, [
>>>>>>> 852dc86bab322c630a0dbcebb67192bf72783ebf
            'name'              => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'arrival_date'      => 'required|date_format:Y-m-d',
            'car_plate_no'      => 'string|nullable',
            'purpose'           => 'required|string', 
<<<<<<< HEAD
            'visiting_period' 	=> 'string',
=======
            'visiting_period'   => 'string',
>>>>>>> 852dc86bab322c630a0dbcebb67192bf72783ebf
        ]);
        $randomToken = Str::random(6);
        DB::beginTransaction(); 
        try{
            $visitor = new Visitor();
            $visitor->name = $request->name;
            $visitor->arrival_date = $request->arrival_date;
            $visitor->car_plate_no = $request->car_plate_no;
            $visitor->purpose = $request->purpose;
            $visitor->status  = 0;
            $visitor->user_id = $this->user->id;
            $visitor->visiting_period = $request->visiting_period;
            $visitor->qr_code = $randomToken;

            //Generate qr image
            $qr_code = $qr->generateCode($randomToken);

            //Upload image 
            $res = $this->upload($request, $image);
            $visitor->image = $res['image'] ? $res['image'] : 'noimage.jpg';
            //Save Visitor
            $this->user->visitors()->save($visitor);
            //if operation was successful save commit+ save to database
            DB::commit();
            // send response
            return response()->json([
                'status'      => true,
                'message'     => 'Visitor successfully added',
                'visitor'     => $visitor,
                'image_info'  => $res,
                'qr_image_src'=> $qr_code
            ], 200);
        }catch(\Exeception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();
            $res['status']   = false;
            $res['message']  = 'Error, Visitor not created, please try again';
            $res['hint']     = $e->getMessage();
            return response()->json($msg, 501);
<<<<<<< HEAD
        }	
=======
        }   
>>>>>>> 852dc86bab322c630a0dbcebb67192bf72783ebf
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
            return response()->json([
                'message' => 'This visitor could not be found, check and try again!'
            ], 404);
        }

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
        ];

        // validate the posted data
        $validator = Validator::make($data, [
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'arrival_date' => 'date_format:Y-m-d',
            'car_plate_no' => 'string|nullable',
            'purpose' => 'string',
            'image' => 'image|max:4000',
            'status' => 'string',
            'time_in' => 'date_format:"Y-m-d H:i:s"',
            'time_out' => 'date_format:Y-m-d H:i:s|nullable',
            'user_id' => 'integer',        
        ]);

        // check if the data is valid
        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        // update the visitor's requested data
        $success = $visitor->update($data);

        // send out response if the update was successful
        if ($success) {
            return response()->json([
                'visitor' => $visitor,
                'status'  => true,
                'message' => "Visitor's data has been updated successfully!"
            ], 200);  
        } else {
            // if the update action fails, send a response
            return response()->json([
                'status'  => false,
                'message' => 'Sorry, this visitor\'s information could not be updated, please try again.'
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

        // output an error if the visitor id is not found
        if (!$visitor) {
            return response()->json(['message' => 'This visitor could not be found!'], 400);
        }
		
		// delete the requested visitor and send a response
		elseif($visitor->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Visitor has been deleted successfully!',
            ], 200);
		} else {
            // if delete action fails, send a response
            return response()->json([
                'status' => false,
                'message' => 'Sorry, this visitor could not be deleted!',
            ], 500);
		}
    }
    public function upload($request, $image) {
        $user = Auth::user();

        $this->validate($request, [
         'image' => "image|max:4000|required",
        ]);
        $res = null;
        if($request->hasFile('image')) {
            //Image Engine
            $res = $image->imageUpload($request);
        }
        return $res;
    }

}


