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

    private function checkphone($phone, $email) {
        $check_phone  = User::where('phone', $phone)->orWhere('email', $email)->exists();
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

           $check = $this->checkphone($request->input('phone'), $request->input('email'));
           if(!$check) {
                $user = User::create([
                    'name'     => ucfirst($request->input('name')),
                    'image'    => 'noimage.jpg',
                    'phone'    => $request->input('phone'),
                    'email'    => $request->input('email'),
                    'user_type'=> $user_type,
                    'role'     => $role,
                    'duty_time' => $duty_time,
                    'device_id' => $request->input('device_id'),
                    'verifycode' => $verifycode
                ]);
                $msg['status'] = 201;
                $msg['app-hint'] = 'This is a new user!';

                Mail::to($user->email)->send(new WelcomeMail($user));
           }else {
                $user = User::where('phone', $request->input('phone'))->orWhere('email',  $request->input('email'))->first();

                $user->email_verified_at = null;
                $user->device_id         = $request->input('device_id');
                $user->verifycode        = $verifycode;
                $user->name              = ucfirst($request->input('name'));
                $user->save();
                
                $msg['status'] = 200;
                $msg['app-hint'] = 'This is an existing user!';
                Mail::to($user->email)->send(new VerifyToken($user));
           }
            $msg['message'] = 'A verification code has been sent to your phone number or email, please use to veriify your account!';
            $msg['user']    = $user;
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
                'email'              => 'required',
                'device_id'          => 'required',
            ];
            $messages = [
                'required' => ':attribute is required',
                'phone'    => ':attribute already exist',
                'device_id'    => ':attribute please give the uniqid device token',
            ];
        $this->validate($request, $rules, $messages);
    }
}
