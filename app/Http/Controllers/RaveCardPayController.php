<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class RaveCardPayController extends Controller
{
	//Triggers the payment and returns a result
    public function triggerProcess($request, $session = null) {

		$this->validate($request, [
            'cardno' =>  ['required', 'string'],
            'currency'  =>  ['required', 'string'],
            'country' => ['string', 'max:2'],
            'cvv'  =>  ['required', 'string', 'min:3', 'max:3'],
            'amount'  =>  ['required', 'string'],
            'expiryyear'  =>  ['required', 'string', 'max:2'],
            'expirymonth' => ['required', 'string', 'max:2'],
            'email'  =>  ['required', 'email'],
        ]);

        $data = $this->payviacard($request, $session);
		return $data;

    }


    //Initiate the payment begin process 
	public function initaiteCardPay(Request $request) {

	    $response = $this->triggerProcess($request);
	    return response()->json(['report' => $response], $response['status']);
	}



	//Insert the card pin to and re-initiate the pay again
    public function insertCardPin(Request $request) {

		$this->validate($request, [
            'suggested_auth' =>  ['required', 'string'],
            "pin" =>  ['required', 'string'],
        ]);
	    $response = $this->triggerProcess($request, $session = 'pin_check');
	    return response()->json(['report' => $response], $response['status']);
	}

	public function otpConfirmation(Request $request) {

		$this->validate($request, [
            'transaction_reference' =>  ['required', 'string'],
            "otp" =>  ['required', 'string'],
        ]);

	     $postdata = array(
	     'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
	     'transaction_reference' => $request->input('transaction_reference'),
	     'otp' => $request->input('otp')
		 );
	     $url =  "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/validatecharge";

	 	$response = $this->curlConnection($postdata, $url);

	 	return response()->json(['report' => $response], $response['status']);

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
	    $url =  "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge";
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

}
