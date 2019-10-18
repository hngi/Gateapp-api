<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// Create a sms otp class
class SmsOtp extends Controller
{
	/**
   * Method to send sms otp
   */
  public function smsOtp()
  {
   try {
        $user = Auth::user();
        $phone = User::where('id', $user->id)->value('phone');
  
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
       CURLOPT_POSTFIELDS =>"{\n    \"message\": \"SMS OTP HERE!\",\n    \"to\": \"{$phone}\",\n    \"sender_id\": \"GateApp\",\n    \"callback_url\": \"https://sms.to/callback/handler\"\n}",
       CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer s92RW6JYLZoU8BizxS8sIpRFr2TE6c9N"
         ),
      ));
   
      $response = curl_exec($curl);
      curl_close($curl);


      $res['status'] = true;
      $res['details'] = 'Otp has been sent successfully.';
      $res['data'] = array(""otp" => $response");
      return response()->json($res, 200);
     } catch(\Exception $e) {

      $res['status'] = false;
      $res['details'] = $e->getMessage();
      $res['data'] = "Error occured while sending OTP.";
      return response()->json($res, 501);
     }
 }
}
