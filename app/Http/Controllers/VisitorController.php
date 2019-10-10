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
		// response array to be sent back to user
		$resp = array(
			'error'    =>  false, // false = Error occured true = successful
			'msg'       =>  '',
		);
		
		// fetch the necesssary data need to be updated for the visitor
		$data = array(
			'visitor_name'        =>  $request->visitor_name,
			'arrival_date'        =>  $request->arrival_date,
			'car_plate_no'        =>  $request->car_plate_no,
			'purpose'             =>  $request->purpose,
			'image'               =>  $request->image,
			'status'              =>  $request->status,
		);
		
		// validate the data sent to ensure that they meet the database structure
		$validator = \Validator::make($data, [
			'visitor_name'        =>  'required|string',
			'arrival_date'        =>  'required|string',
			'car_plate_no'        =>  'required|string',
			'purpose'             =>  'required|string',
			'image'               =>  'required|string',
			'status'              =>  'required|string',
		]);
		
		// checkes if the data is valid
		if($validator->fails()) {
			return response()->json($validator->errors());
		}
		
		// gets the visitors record from the database
		$visitor = Visitor::findorfail($id);
		
		// passes the data to the model to update the visitor record
		$success = $visitor->update($data);
		
		// if the data is updated successfully then send back feedback
		if($success) {
			$resp['error']   = true;
			$resp['msg']  = "Visitor information updated successfully";
		} else {
			$resp['error']   = false;
			$resp['msg']  = "We could not update the information now, please try again";
		}
		
		return response()->json($resp);
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