<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Home;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GetPayment extends Controller
{
	public function getPayment($id)
	{
		$user = Auth::user();

		
            
    

	    $payment_details = Payment::wherepayment_id($id)->first();

	   if ($payment_details) {

		   $home = Home::wherehome_id($payment_details->home_id)->first();
			if ($home) {
				if ($user->id == $home->user_id) {
					$payment['msg'] = "Payment was found";
				   	$payment['payment_details'] = $payment_details;
				   	$status = 200;
				}else{
					$payment['msg'] = "Payment not traceble to you";
				   	$payment['payment_details'] = null;
				   	$status = 404;
				}
			}else{
				$payment['msg'] = "Payment not traceble to your home";
			   	$payment['payment_details'] = null;
			   	$status = 404;
			}
	   	}else{

		   	$payment['msg'] = "Could not find payment";
		   	$payment['payment_details'] = null;
		   	$status = 404;
	   	}
		return response()->json($payment, $status);
	}

	public function postPayment(Request $request)
	{
		$user = Auth::user();
		 $this->validate($request, [
            'home_id' => 'required|min:1',
            'amount' => 'required|min:1',
        ]);

		$home_id_recieved = $request->input('home_id');
		$payment_amount_recieved = $request->input('amount');

		// for testing things out without view(form data) uncomment the next three lines while the home and payment tables are available
		// $home_id_recieved = isset($home_id_recieved) ? $home_id_recieved : '1';
		// $payment_amount_recieved = isset($payment_amount_recieved) ? $payment_amount_recieved : '1200';
		// $payment_date_recieved = isset($payment_date_recieved) ? $payment_date_recieved : '2019-10-09 16:16:18';

		$home = Home::wherehome_id($home_id_recieved)->first();
		if ($home) {
			

		 	$payment = new Payment();

	        $payment->home_id = $home_id_recieved;
		 	$payment->amount = $payment_amount_recieved;

	        if ($payment->save()) {

		        $insert_id = $payment->id;
		        $new_payment = Payment::wherepayment_id($insert_id)->first();

	        	$data['msg'] = "Payment saved successfully";
	        	$data['payment_details'] = $new_payment;
	        	$status = 200;

	        }else{

	        	$data['msg'] = "Failed to save payment, please try again";
	        	$data['payment_details'] = null;
	        	$status = 404;
	        }

		}else{

			$data['msg'] = "Home not found, failed to save payment for unknown home";
			$data['payment_details'] = null;
			$status = 404;
		}
	    return response()->json($data, $status);
	}

}
