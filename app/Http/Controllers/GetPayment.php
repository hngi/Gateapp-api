<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Home;

class GetPayment extends Controller
{
	public function getPayment($id)
	{
	    $payment_details = Payment::wherePayment_id($id)->first();

	   if ($payment_details) {

		   	$payment['msg'] = "Payment was found";
		   	$payment['payment_details'] = $payment_details;
		   	$status = 200;
	   	}else{

		   	$payment['msg'] = "Could not find payment";
		   	$payment['payment_details'] = null;
		   	$status = 404;
	   	}
		return response()->json($payment, $status);
	}

	public function postPayment(Request $request)
	{
		$home_id_recieved = $request->input('home_id');
		$payment_amount_recieved = $request->input('amount');
		$payment_date_recieved = $request->input('date_paid');

		
		$testing = false;//set this to true on test
		if ($testing === true) {//remove this block when you are done testing or set the testing variable to false;

			$home = new Home();

	        $home->occupant_id = 1;
		 	$home->estate_id = 1;
	        $home->house_no = 1;
	        $home->qr_code = "23fcfd56";

	        $home->save();

			$home_id_recieved =  $home->id;
			$payment_amount_recieved =  '1200';
			$payment_date_recieved = '2019-10-09 16:16:18';
		}

		$home = Home::wherehome_id($home_id_recieved)->first();
		if ($home) {

		 	$payment = new Payment();

	        $payment->home_id = $home_id_recieved;
		 	$payment->amount = $payment_amount_recieved;
	        $payment->date_paid = $payment_date_recieved;

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
