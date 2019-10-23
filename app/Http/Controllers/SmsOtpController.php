<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// Create a sms otp class
class SmsOtpController extends Controller
{
	/**
   * Method to send sms otp
   */

  private $url = "https://api.sms.to/sms/send";
  private $bearer_token = "";
  private $sender = "GatePass App";

  public function smsOtp($phone, $msg)
  {
   try {
  
        $curl = curl_init();
  
       // API token from @junicode
         
       curl_setopt_array($curl, array(
       CURLOPT_URL => $this->url,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS =>"{\n    \"message\": \"{$msg}\",\n    \"to\": \"{$phone}\",\n    \"sender_id\": \"{$this->sender}\",\n    \"callback_url\": \"https://sms.to/callback/handler\"\n}",
       CURLOPT_HTTPHEADER => array(
         "Content-Type: application/json",
         "Accept: application/json",
         "Authorization: Bearer ".$this->bearer_token
           ),
      ));
   
      $response = curl_exec($curl);
      curl_close($curl);

      // $res['status']        =  true;
      // $res['data']          =  $response;
      // $res['status_code']   =  200;
      // return $res;
     } catch(\Exception $e) {

      // $res['status'] = false;
      // $res['details'] = $e->getMessage();
      // $res['data'] = "Error occured while sending OTP.";
      // $res['status_code']   =  501;
      // return $res;
     }
 }
}
