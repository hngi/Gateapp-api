<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\ResidentBill;
use App\EstateBills;

class RaveCardPayController extends Controller
{
	//Triggers the payment and returns a result
    public function triggerProcess($request, $session = null) {
		$data = $this->payviacard($request, $session);
		return $data;
	}

    //Initiate the payment begin process 
	public function initaiteCardPay(Request $request) {

		//Laravel Validation
		$this->validatePaymentData($request);
		//Check if the user is paying the rigth amount
		$check_amt = $this->checkBillAmount($request);
		if($check_amt == 'error'){
			return response()->json(['message' => 'Incorrect Amount for bill payment or bill does not exist'], 400);
		}
		
		if($check_amt == 'paid'){
			return response()->json(['message' => 'Payment already made for this bill'], 422);
		}
		$response = $this->triggerProcess($request);
		//Call the bill information
		$fetchBill = $this->getBillInfo($request);
	    return response()->json(['report' => $response, 'bill_info' => $fetchBill], $response['status']);
	}


	//Insert the card pin to and re-initiate the pay again
    public function insertCardPin(Request $request) {

		$this->validate($request, [
			'bill_id' => ['required'],
            'suggested_auth' =>  ['required', 'string'],
            "pin" =>  ['required'],
		]);
		//Check if the user is paying the rigth amount
		$check_amt = $this->checkBillAmount($request);
		if($check_amt == 'error'){
			return response()->json(['message' => 'Incorrect Amount for bill payment or bill does not exist'], 400);
		}
		$response = $this->triggerProcess($request, $session = 'pin_check');
		//Call the bill information
		$fetchBill = $this->getBillInfo($request);
	    return response()->json(['report' => $response,'bill_info' => $fetchBill], $response['status']);
	}

	public function otpConfirmation(Request $request) {

		$this->validate($request, [
			'bill_id' => ['required'],
            'transaction_reference' =>  ['required', 'string'],
			"otp" =>  ['required', 'string']
        ]);

	     $postdata = array(
	     'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
	     'transaction_reference' => $request->input('transaction_reference'),
	     'otp' => $request->input('otp')
		 );
		 $url = env('RAVE_CARD_VERIFY_URL');

		 $billStore = $this->storeBill($request);

		 $response  = $this->curlConnection($postdata, $url);
		 
		$fetchBill = $this->getBillInfo($request);
		return response()->json(['report' => $response, 'bill_info' => $fetchBill], $response['status']);

	}
	public function checkBillAmount($request) {
		//Validate the Bill Amount
		$bill_id = $request->input('bill_id');
		$amount  = number_format($request->input('amount'), 2);
		$user_id     = Auth::user()->id;

		$bill_result_check = EstateBills::where('id', (int)$bill_id)->exists();

		if($bill_result_check) {
			$bill_result = EstateBills::where('id', (int)$bill_id)->first();
	
			if($amount != number_format($bill_result->base_amount, 2)) {
				return 'error';
			}
			//Check if this user has already paid for a bill to prevent any futher payment
			$resident_bill = ResidentBill::where('users_id', $user_id)
								->where('estate_bills_id', (int)$bill_id)
								->where('status', 1)
								->exists();
			if($resident_bill) {
				return 'paid';
			}
		}else {
			return 'error';
		}

	}

	public function getBillInfo($request) {
		//Get the bill infomation form the bill table
		$bill_id     = $request->input('bill_id');
	
		$bill_result = EstateBills::where('id', (int)$bill_id)  
					   ->with('estates')
					   ->first();
		return $bill_result;
	}


    public function storeBill($request) {
		//Store the bill status as successfully paid
		$user_id     = Auth::user()->id;
		$bill_id     = $request->input('bill_id');

		try{
			$resident_bill = ResidentBill::where('users_id', $user_id)
							->where('estate_bills_id', (int)$bill_id)
							->first();

			if($resident_bill) {
				$resident_bill->status = 1;
				$resident_bill->payment_mode = 'Card Payment';
				$resident_bill->save();
				return 'success saved';
			}else {
				return [
					'error' => 'Sorry you are not permitted to pay for this bill'
				];
			}
			
		} catch(\Exception $e) {
			return [
				'error' => 'An error occured while saving bill',
				'hint' => $e->getMessage()
			];
		}
	}

    // this is the getKey function that generates an encryption Key for you by passing your Secret Key as a parameter.
	public function getKey($seckey) {

	  $hashedkey = md5($seckey);
	  $hashedkeylast12 = substr($hashedkey, -12);

	  $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
	  $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);

	  $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
	  return $encryptionkey;

	}



	//3Des Military Security
	public function encrypt3Des($data, $key) {

	  $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
	        return base64_encode($encData);
	}




	public function payviacard($request, $session){ // set up a function to test card payment.

	    $data = array(
	    'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
	    'cardno' => $request->input('cardno'),
	    'currency' => $request->input('currency'),
	    'country' => $request->input('country'),
	    'cvv' => $request->input('cvv'),
	    'amount' => $request->input('amount'),
	    'expiryyear' => $request->input('expiryyear'),
	    'expirymonth' => $request->input('expirymonth'),
	    'email' => $request->input('email'),
	    'IP' => $request->ip(),
	    'txRef' => "GateGuard". mt_rand(1000,9999) . Carbon::now());

	    // dd($data);
	    if($session == 'pin_check') {
	    $data = array_merge($data, [
	     	"suggested_auth" => $request->input('suggested_auth'),
			"pin" => $request->input('pin'),
	     ]);
	    }
	    //Rave Flutter Secret Key
	    $SecKey = env('RAVE_SECRET_KEY');
	    
	    $key = $this->getKey($SecKey); 
	    
	    $dataReq = json_encode($data);
	    
	    $post_enc = $this->encrypt3Des( $dataReq, $key );

	    // var_dump($dataReq);
	    
	    $postdata = array(
	     'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
	     'client' => $post_enc,
	     'alg' => '3DES-24');
	    $url =  env('RAVE_CARD_INITIATOR_URL');
		 $result = $this->curlConnection($postdata, $url);
		
	 	return $result;
	}


	public function curlConnection($postdata, $url) {

		$ch = curl_init();
	    
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 200);
	    
	    
	    $headers = array('Content-Type: application/json');
	    
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    
	    $request = curl_exec($ch);
	    
	    if ($request) {

	        $result = json_decode($request, true);
	        $res['res'] = $result;
			$res['status'] = 200;
			
	        return $res;
	    }else{
	        if(curl_error($ch))
	        {
	          $res['err'] = curl_error($ch);
	          $res['status'] = 501;
	          return $res;
	        }
	    }
	    
	    curl_close($ch);
	}


	private function validatePaymentData($request) {
		return $this->validate($request, [
					'cardno' =>  ['required', 'string'],
					'currency'  =>  ['required', 'string'],
					'country' => ['string', 'max:2'],
					'cvv'  =>  ['required', 'string', 'min:3', 'max:3'],
					'amount'  =>  ['required', 'string'],
					'expiryyear'  =>  ['required', 'string', 'max:2'],
					'expirymonth' => ['required', 'string', 'max:2'],
					'email'  =>  ['required', 'email'],
					'bill_id' => ['required']
				]);
	}

}
