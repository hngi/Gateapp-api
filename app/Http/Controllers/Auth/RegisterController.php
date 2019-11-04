<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\SmsOtpController;
use App\Mail\WelcomeMail;
use App\Mail\VerifyToken;

class RegisterController extends Controller
{

    public function admin(Request $request) {
        $msg = $this->create($request, $role='0', $user_type='admin', $duty_time=null );

        return response()->json($msg, $msg['status']);
    }

    
    public function resident(Request $request) {
        $msg = $this->create($request, $role='1', $user_type='resident', $duty_time=null);

        return response()->json($msg, $msg['status']);
    }

    public function gateman(Request $request) {
        $msg = $this->create($request, $role='2', $user_type='gateman', $duty_time ='0');

        return response()->json($msg, $msg['status']);
    }

    private function checkphone($phone) {
        $check_phone  = User::where('phone', $phone)->exists();
       if ($check_phone) {
           return true;
       }return false;
    } 

    public function create($request, $role, $user_type, $duty_time)
    {
        
        $this->validateRequest($request);
        $verifycode = mt_rand(1000,9999);

        //start temporay transaction
        DB::beginTransaction();

        try{
           $smsOtpController = new SmsOtpController;
           $phone = $request->input('phone');
           $check = $this->checkphone($phone);
           if(!$check) {
                $user = User::create([
                    'name'     => ucfirst($request->input('name')),
                    'image'    => 'noimage.jpg',
                    'phone'    => $phone,
                    'user_type'=> $user_type,
                    'role'     => $role,
                    'duty_time' => $duty_time,
                    'device_id' => $request->input('device_id'),
                    'verifycode' => $verifycode
                ]);
                $msg['status'] = 201;
                $msg['app-hint'] = 'This is a new user!';
                
                //Send sms otp to user
                $phone     = $user->phone;
                $message   = 'Welcome to GateGuard, please this  4 digit otp token to verify your account '. $user->verifycode;
                // $result = $smsOtpController->africasTalking($phone, $message);
           }else {
                
                $user = User::where('phone', $phone)->first();

                $user->email_verified_at = null;
                $user->device_id         = $request->input('device_id');
                $user->verifycode        = $verifycode;
                $user->name              = ucfirst($request->input('name'));
                $user->save();
                
                $msg['status']   = 200;
                $msg['app-hint'] = 'This is an existing user!';
                //Send sms otp to user
                $phone        = $user->phone;
                $current_user = $user->name != '' ? $user->name : 'member';
                $message  = 'Welcome back '.$current_user.' please use this 4 digit otp to re-verify your account '. $user->verifycode;
                // $result = $smsOtpController->africasTalking($phone, $message);
           }
            $msg['message'] = 'A verification otp has been sent to your phone, please use to veriify your account!';
            $msg['user']    = $user;
            // $msg['otp'] = $result;
            $msg['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
            $msg['image_round_format']  = 'w_200,c_fill,ar_1:1,g_auto,r_max/';
            $msg['image_square_format'] = 'w_200,ar_1:1,c_fill,g_auto/';
            $msg['image_example_link']  = 'https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/noimage.jpg';


            DB::commit();
            return $msg;

        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $res['message'] = "Error: Account not created, please try again!";
            $res['user'] = null;
            $res['hint'] = $e->getMessage();
            $res['status'] = 501;
            return $res;
        }
    }

    public function validateRequest(Request $request){
            $rules = [
                'name'               => 'required|string',
                'phone'              => 'required',
                'device_id'          => 'required',
            ];
            $messages = [
                'required' => ':attribute is required',
                'phone.regex'    => ':attribute phone number is invalid',
                'device_id'    => ':attribute please give the uniqid device token',
            ];
        $this->validate($request, $rules, $messages);
    }
}
