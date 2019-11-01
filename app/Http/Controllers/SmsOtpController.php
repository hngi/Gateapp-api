<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\User;
// Create a sms otp class
class SmsOtpController extends Controller
{
	// private $USERNAME   = 'sandbox';
  // private $FROM       = "GateGuard";
  // private $API_TOKEN  = "120901657ad012358be654f7a69b2a8cba8647ce95312f77b52ec3ceeb04928e";
  private $USERNAME   = 'gateguard';
  private $FROM       = "AFRICASTKNG";
  private $API_TOKEN  = "07ae042d925e7632d8f6bf10b9a37ee892ae59d689b866bf43b4ace6eb5cb841";

  private $from = "GateGuard OTP";
  private $api_token   = 'QLTtEV2m4u2xDoQJLCR5t98UwXG9X2RJDil8aaG3XcGMxjqshFeVBO2bDciI';
  //This otp method need the phone number and message as parameter
  public function bulkSmsNigeria($phone, $message)
  {   
      $res = $this->initiateSmsGuzzle($phone, $message);
      return $res;
  }
  
  public function initiateSmsGuzzle($phone, $message)
  {

    $client = new Client();
    try{
        $response = $client->post('https://www.bulksmsnigeria.com/api/v1/sms/create', [
          'verify'    =>  false,
          'form_params' => [
            'api_token' => $this->api_token,
            'from' => $this->from,
            'to' => $phone,
            'body' => $message,
          ],
          ]);
          $response = json_decode($response->getBody(), true);
          if($response) {
            $res['status']   = true;
            $res['message']  = 'OTP has been sent successfully';
            $res['response'] = $response;
            return $res;
          }else {
            $res['status']   = false;
            $res['message']  = 'OTP not sent';
            $res['response'] = $response;
            return $res;
          }
        
      } catch (Exception $e) {

          $res['status']   = false;
          $res['message']  = '(Not Implemented) Otp not sent';
          $res['response'] = $response;
          return $res;
      }
    }

 public function africasTalking($recipients, $message) {
    // Set your app credentials

    // Initialize the SDK
    $AT = new AfricasTalking($this->USERNAME, $this->API_TOKEN);

    // Get the SMS service
    $sms = $AT->sms();

    // Set your shortCode or senderId

    try {
        // Thats it, hit send and we'll take care of the rest
        $result = $sms->send([
            'to'      => $recipients,
            'message' => $message,
            'from'    => $this->FROM
        ]);
      
      $res['status'] = true;
      $res['result'] = $result;

      return $res;
    } catch (Exception $e) {
      $res['status'] = true;
      $res['result'] = $result;
      $res['status_code'] = 501;
      $res['hint']   = $e->getMessage();
      return $res;
    }
 }
}
