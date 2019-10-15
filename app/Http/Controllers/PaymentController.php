<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Home;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
	//Fetch all resisdent payment
	public function aUserPayment($id) {
	    $user = Auth::user();
	    $payments = Payment::where('user_id', $id)
    			->with(['home' => function($query){
                    $query->with('estate');
                 }])
    			->with('user')
    			->get();
    	foreach ($payments as $payment) {
    		$home = Home::where('id', $payment->home_id)->first();
			if (!$home && ($user->id == $home->user_id)) {
				$res['message'] = "Payment not traceble to your home";
			   	$res['payment'] = null;
			   	$res['status'] = 404;
			   	return response()->json($res, $res['status']);
			}
    	}
		$res = $this->getPayment($payments);
		return response()->json($res, $res['status']);
	}
	//fetch all payment by a user
	public function oneUniquePayment($id) {
	   $user = Auth::user();
	   $payments = Payment::where('id', $id)
	    			->with(['home' => function($query){
	                    $query->with('estate');
	                 }])
	    			->with('user')
	    			->first();
	    $home = Home::where('id', $payments->home_id)->first();
		if (!$home && ($user->id == $home->user_id)) {
			$res['message'] = "Payment not traceble to your home";
		   	$res['payment'] = null;
		   	$res['status'] = 404;
		   	return response()->json($res, $res['status']);
		}
		 $res = $this->getPayment($payments);
		 return response()->json($res, $res['status']);
	}
    public function getPayment($payments)
	{
	   if(!$payments) {
		   	$res['message'] = "Could not find payment";
		   	$res['payment'] = null;
		   	$res['status'] = 404;
		   	return $res;
	   	}

		$res['message'] = "Payment was found";
     	$res['payment'] = $payments;
   	    $res['status'] = 200;
	   	return $res;
	}

	public function postPayment(Request $request, Payment $payment, $home_id) {

		$user = Auth::user();
		$check_home_id = Home::where('id', $home_id)->exists();

		if($check_home_id) {

			$this->validate($request, [
	            'amount' => 'required|min:1',
	        ]);

			 //start temporay transaction
       		 DB::beginTransaction();
	        try {
		        $payment->home_id = $request->input('home_id');
			 	$payment->amount  = $request->input('amount');
			 	$payment->save();

			 	//if operation was successful save commit save to database
    			DB::commit();
	        	$data['message'] = "Payment saved successfully";
	        	$data['payment'] = $payment;
		        	return response()->json($data, 200);
	         }catch(\Exception $e) {

	        	//if any operation fails, Thanos snaps finger - user was not created rollback what is saved
          		DB::rollBack();
	        	$data['message'] = "Failed to save payment, please try again";
	        	$msg['hint'] = $e->getMessage();
	        	return response()->json($data, 501);
	        }
		}else{
			$data['message'] = "Home not found";
			$status = 404;
		}
		
	}

}
