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
        $msg = $this->create($request, $role='0');

        return response()->json($msg, $msg['status']);
    }

    public function resident(Request $request) {
        $msg = $this->create($request, $role='1');

        return response()->json($msg, $msg['status']);
    }

    public function gateman(Request $request) {
        $msg = $this->create($request, $role='2');

        return response()->json($msg, $msg['status']);
    }

    public function create($request, $role)
    {
        $this->validateRequest($request);
        $verifycode = Str::random(6);
        //start temporay transaction
        DB::beginTransaction();

        try{
           $user = User::create([
                'name'     => $request->input('name'),
                'image'    => 'no_image.jpg',
                'phone'    => $request->input('phone'),
                'role'     => $role,
                'verifycode' => $verifycode
            ]);

            $msg['message'] = 'A verification code has been sent to your phone number, please use to veriify your account!';
            $msg['user']    = $user;

            //Send a mail form account verification(Dont need the message here we are using sms instead)
            // Mail::to($user->email)->send(new WelcomeMail($user));
            //if operation was successful save commit save to database
            DB::commit();
            $msg['status'] = 201;
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
                'name'           => 'required|string',
                'phone'          => 'required|phone|unique:users',
                'device_type'    => 'required|device_type|unique:users',
            ];
            $messages = [
                'required' => ':attribute is required',
                'phone'    => ':attribute already exist',
            ];
        $this->validate($request, $rules, $messages);
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }
}
