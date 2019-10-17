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

class RegisterController extends Controller
{

    public function admin(Request $request) {
        $msg = $this->create($request, $role='0', $user_type='admin');

        return response()->json($msg, $msg['status']);
    }

    public function resident(Request $request) {
        $msg = $this->create($request, $role='1', $user_type='resident');

        return response()->json($msg, $msg['status']);
    }

    public function gateman(Request $request) {
        $msg = $this->create($request, $role='2', $user_type='gateman');

        return response()->json($msg, $msg['status']);
    }

    private function checkphone($phone, $email) {
        $check_phone  = User::where('phone', $phone)->orWhere('email', $email)->exists();
       if ($check_phone) {
           return true;
       }return false;
    } 

    public function create($request, $role, $user_type)
    {
        $this->validateRequest($request);
        $verifycode = Str::random(6);
        //start temporay transaction
        DB::beginTransaction();

        try{

           $check = $this->checkphone($request->input('phone'), $request->input('email'));
           if(!$check) {
                $user = User::create([
                    'name'     => $request->input('name'),
                    'image'    => 'no_image.jpg',
                    'phone'    => $request->input('phone'),
                    'email'    => $request->input('email'),
                    'user_type'=> $user_type,
                    'role'     => $role,
                    'device_id' => $request->input('device_id'),
                    'verifycode' => $verifycode
                ]);
                $msg['status'] = 201;
                $msg['app-hint'] = 'this is a new user!';
           }else {
                $user = User::where('phone', $request->input('phone'))->first();
                $user->device_id = $request->input('device_id');
                $user->save();
                
                $msg['status'] = 200;
                $msg['app-hint'] = 'this is an existing user!';
           }
            $msg['message'] = 'A verification code has been sent to your phone number or email, please use to veriify your account!';
            $msg['user']    = $user;

            //Send a mail form account verification(Dont need the message here we are using sms instead)
            Mail::to($user->email)->send(new WelcomeMail($user));
            //if operation was successful save commit save to database
            DB::commit();
            return $msg;


        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $msg['message'] = "Error: Account not created, please try again!";
            $msg['user'] = null;
            $msg['hint'] = $e->getMessage();
            $msg['status'] = 501;
            return $msg;
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
