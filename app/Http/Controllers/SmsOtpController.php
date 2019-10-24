<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\User;

// Create a sms otp class
class SmsOtpController extends Controller
{
	/**
   * Method to send sms otp
   */

  private $url = "https://api.sms.to/sms/send";
  private $authKey = "";
  private $sender = "GatePass App";

  public function smsOtp($phone, $msg)
  {
   try {
  
        $curl = curl_init();
  
       // API token from @junicode
        $postData  = array(
         'authkey' => $authKey,
         'mobiles' => $mobile,
         'message' => $message,
         'sender'  => $senderId,
         'route'   => $route
       );
       curl_setopt_array($curl, array(
       CURLOPT_URL => $this->url,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS =>$postData,
       CURLOPT_HTTPHEADER => array(
         "Content-Type: application/json",
         "Accept: application/json",
         "Authorization: Bearer ".$this->authKey
           ),
      ));
   
      $response = curl_exec($curl);
      curl_close($curl);

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
    $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";

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
