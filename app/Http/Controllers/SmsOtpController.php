<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\User;
// Create a sms otp class
class SmsOtpController extends Controller
{
	
  public function smsOtp($phone="&to=07060959269")
  {  
     // $this->to = $phone;
     $body="Your Otp token is ".mt_rand(1000,9999);
   try {
  
        // Account details
  $apiKey = urlencode('WDRlRPJ6+Js-rm9JwdiHJatVEGfuGCIiMzv0goqmrM');
  
        // Message details
        $numbers = array(2348111570173);
        $sender = urlencode('GateGuard');
        $message = rawurlencode($body);
       
        $numbers = implode(',', $numbers);
       
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
       
        // Send the POST request with cURL
        $ch = curl_init('https://api.txtlocal.com/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // Process your response here
      // $res['status']        =  true;
      // $res['data']          =  $response;
      // $res['status_code']   =  200;
      // return $res;
      return response()->json($response, 200);
     } catch(\Exception $e) {

      // $res['status'] = false;
      // $res['details'] = $e->getMessage();
      // $res['data'] = "Error occured while sending OTP.";
      // $res['status_code']   =  501;
      // return $res;
        return response()->json($e->getMessage(), 200);
     }
 }

 public function africasTalkingTest() {
    // Set your app credentials
    $username   = "sandbox";
    $apiKey     = "622aa1de1ec8132c2371d0c1c784b23fa20e822836bc50fa846ae618010b5f75";

    // Initialize the SDK
    $AT         = new AfricasTalking($username, $apiKey);

    // Get the SMS service
    $sms        = $AT->sms();

    // Set the numbers you want to send to in international format
    $recipients = "+2347060959269";

    // Set your message
    $message    = "Your OTP Token is: 8979";

    // Set your shortCode or senderId
    $from       = "GatePass01";

    try {
        // Thats it, hit send and we'll take care of the rest
        $result = $sms->send([
            'to'      => $recipients,
            'message' => $message,
            'from'    => $from
        ]);

      return response()->json($result, 200);
    } catch (Exception $e) {
        return response()->json($e->getMessage(), 200);
    }
 }



}
