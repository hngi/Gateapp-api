<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// Create a sms otp class
class SmsOtp extends Controller
{
	/**
   * Method to send sms otp to gateman
   */
  public function smsOtp($phone)
  {
   try {
        $phone = User::where('phone', $phone)->exists();
        // Let me quickly check if number exists in our database
        if(!$phone)
        {
         throw new \Exception('Phone Number Does Not Exists In Our Database.');
        }
  
       $curl = curl_init();
  
       // API token from @junicode
         
       curl_setopt_array($curl, array(
       CURLOPT_URL => "https://api.sms.to/sms/send",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS =>"{\n    \"message\": \"Gateman Messsage Here!\",\n    \"to\": \"{$phone}\",\n    \"sender_id\": \"GateApp\",\n    \"callback_url\": \"https://sms.to/callback/handler\"\n}",
       CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer s92RW6JYLZoU8BizxS8sIpRFr2TE6c9N"
         ),
      ));
   
      $response = curl_exec($curl);
      curl_close($curl);


      $res['status'] = true;
      $res['data'] = array(""otp" => $response");
      return response()->json($res, 200);
     } catch(\Exception $e) {

      $res['status'] = false;
      $res['error_details'] = $e->getMessage();
      $res['data'] = "Error occured while sending OTP.";
      return response()->json($res, 501);
     }
 }
}
