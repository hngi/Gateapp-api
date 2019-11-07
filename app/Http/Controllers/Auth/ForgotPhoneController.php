<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SmsOtpController;
use App\Mail\VerifyToken;

use App\User;

class ForgotPhoneController extends Controller
{
    //generate verify code for the user
    public function generatedCode()
    {
         return mt_rand(1000,9999);
    }


    public function verifyPhone(Request $request)
    {

    // Do a validation for the input
        $this->validate($request, [
            'old_phone' => 'required',
            'new_phone' => 'required',
            'new_device_id' => 'required',
        ]);
        $user = User::where('phone', $request->input('old_phone'))->first();

           if ($user == null)
           {
                $res['success'] = false;
                $res['message'] = 'User not found!';
                return response()->json($res, 404);
           }
        //start temporay transaction
        DB::beginTransaction();
        try{
            $phone = $request->input('phone');
            //generate a new verify code 
            $user->email_verified_at  = null;
            $user->phone            = $phone;
            if ($user->device_id != $request->input('new_device_id')) {
                  $user->device_id = $request->input('new_device_id');
             }
            $user->verifycode = $this->generatedCode();
            $user->save();

            $phone        = $user->phone;
            $current_user = !$user->name->isEmpty() ? $user->name : 'member';
            $message      = 'Hello'.$current_user.' user this 4 digit otp to verify new phone '. $user->verifycode;
            $smsOtpController = new SmsOtpController; 
            // $smsOtpController->africansTalking($phone, $message);
            //Commit changes 
            DB::commit();

            $res['success'] = true;
            $res['message'] = 'An otp token has ben sent to you phone because you requested for a change of phone number';
            return response()->json($res, 200);
          } catch (\Exception $e) {

            //Rollback if there is an erro
             DB::rollBack();
             $res['success'] = false;
             $res['message'] = 'OTP Token not sent. Please try again!';
            $res['hint'] = $e->getMessage();
             return response()->json($res, 501);
          }
    }

    public function resedToken(Request $request) {
        // Do a validation for the input
        $this->validate($request, [
            'phone' => 'required',
        ]);
           $phone = $request->input('phone');
           $user = User::where('phone', $phone)->first();
           if ($user == null) {
                $res['success'] = false;
                $res['message'] = 'User not found!';
                return response()->json($res, 404);
           }else {
             //start temporay transaction
                DB::beginTransaction();
                try{
                    $message   = 'Use this verification otp to verify your account '. $user->verifycode;
                    $smsOtpController = new SmsOtpController; 
                    // $result = $smsOtpController->africasTalking($phone, $message);
                    //Commit changes 
                    DB::commit();

                    $res['success'] = true;
                    $res['message'] = 'OTP token has been sent. Please check your phone to verify account!';
                    return response()->json($res, 200);

                  } catch (\Exception $e) {

                    //Rollback if there is an erro
                    DB::rollBack();
                    $res['success'] = false;
                    // $msg['otp'] = $result;
                    $res['message'] = 'OTP Token not sent. Please try again!';
                    $res['hint']    = $e->getMessage();
                    return response()->json($res, 501);
                 }
           }
    }
}
