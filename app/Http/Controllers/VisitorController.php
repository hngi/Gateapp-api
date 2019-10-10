<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    //Get all visitor
    public function index($page = null)
    {
        $res = Visitor::get();

        return response()->json([
        	'error' => false,
        	'data' => $res,
        	'status' => true,
        ], 200);
    }

    public function store(Request $request)
    {
    	$visitor = Visitor::create($request->all());
    	
    	// validate request
        return response()->json([
            'error'   => false,
            'visitor' => $visitor,
            'status'  => true,
            'message' => 'Visitor successfully added',
        ], 200);	
    }

    //Get single visitor
    public function show($id)
    {

        $res = Visitor::find($id);
        if (is_null($res)) {
            return response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json($res, 200);
    }

	public function update(Request $request, $id) {
		$visitor = Visitor::find($id);

        if (is_null($visitor)) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

		$visitor->update($request->all());

		if ($visitor) {
	        return response()->json([
	            'error'   => false,
	            'visitor' => $visitor,
	            'status'  => true,
	            'message' => 'Visitor information updated successfully'
	        ], 200);	
		} else {
			$resp['error']   = true;
			$resp['message']  = 'We could not update the information now, please try again';

			return response()->json($resp);
		}
	}

	public function destroy($id) {
		// response array to be sent back to user
		$resp = array(
			'error'    =>  false, // false = Error occured true = successful
			'msg'       =>  '',
		);
		
		// delete the visitor record
		$visitor = Visitor::findorfail($id);
		
		$success = $visitor->delete();
		
		// if the data is updated successfully then send back feedback
		if($success) {
			$resp['error']   = true;
			$resp['msg']  = "Visitor information deleted successfully";
		} else {
			$resp['error']   = false;
			$resp['msg']  = "We could not delete this visitor";
		}
		
		return response()->json($resp);
	}

}