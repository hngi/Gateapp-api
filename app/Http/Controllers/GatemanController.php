<?php

namespace App\Http\Controllers;

use App\Gateman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GatemanController extends Controller
{
    /**
     * @var string $user
     * @access protected
     */
    protected $user;

    public function __construct()
    {
    	$this->user = auth()->user();
    }

	/**
	 * Gets all residents request for the gateman
	 */
    public function residentRequest()
    {
    	// ensure user has the gateman role
        if ($this->user->role != '2') {
	        return response()->json([
	        	'status' => false,
	        	'message' => 'User is not a registered gateman',
	        ], 200);
        }


        $residents = Gateman::where('request_status', 1);

        if (!$residents) {

            $res['message'] = "Invitations not found";
            $res['payment'] = null;
            $res['status'] = 404;
            return response()->json($res, $res['status']);
        }else{
            $stach_details = [];
            foreach ($residents as $resident) {
                if ((!empty($resident->user_id)) && $this->user->id == $resident->gateman_id)) {
                    $User = User::where('id', $resident->user_id);
                    if ($User) {
                        // user Exist,then push detials
                        array_push($stach_details, $User);
                    }
                }
            }
            //  returning resident users that invited current gateman user
            $res['message'] = "Invitations from residents was found";
            $res['resident_details'] = $stach_details;
            $res['status'] = 200;

            return response()->json($res, $res['status']);
        }


    }

    /**
     * Method to update gateman's response to resident's request
     */
    public function response()
    {

    }

    /**
     * Method to display all visitors of the resident whom
     * the gateman is assigned to 
     */
    public function viewVisitors()
    {

    }

    /**
     * 
     */
    public function admitVisitors()
    {

    }
    
    /**
     * Method to send sms otp to gateman
     */
    public function smsOtp($phone, $msg)
    {
     if(isset($phone) && isset($msg))
     {
      $number = User::where('phone', $phone)->get();
      // Let me quickly check if number exists in our database
      if(isset($number))
      {
       $res['status'] = true;
      }
       else
      {
       $res['status'] = false;
       $res['data'] = "Error occured while sending OTP.";
       return response()->json($res, 501);
       exit();
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
      CURLOPT_POSTFIELDS =>"{\n    \"message\": \"{$msg}\",\n    \"to\": \"{$number}\",\n    \"sender_id\": \"GateApp\",\n    \"callback_url\": \"https://sms.to/callback/handler\"\n}",
      CURLOPT_HTTPHEADER => array(
       "Authorization: Bearer s92RW6JYLZoU8BizxS8sIpRFr2TE6c9N"
         ),
      ));
        
     $response = curl_exec($curl);

     curl_close($curl);
   
     $res['data'] = array(""otp" => $response");
     return response()->json($res, 200);
    }
  }
}
