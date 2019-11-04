<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class VerificationController extends Controller
{
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

      //generate new password for the user
    public function generatedPassword()
    {
        return mt_rand(1000,9999);
    }

    public function expireTime() {
        $myTTL = 120960; //minutes
        return $this->jwt->factory()->setTTL($myTTL);
    }
    public function verify(Request $request, User $user) {

        $this->validate($request, [
            'verifycode'  => 'required|max:6',
            'device_id' => 'required'
        ]);

        $this->expireTime();

        $verifycode = $request->input('verifycode');
        $checkCode  = User::where('verifycode', $verifycode)->exists();

        if ($checkCode) {

            $user = User::where('verifycode', $verifycode)->first();

            $token = Auth::guard()->login($user);
    
                //generate a new verify code 
                $user->verifycode  =  $this->generatedPassword();
                $user->email_verified_at = date("Y-m-d H:i:s");
                $user->device_id  = $request->input('device_id');
                $user->save();
                
                $msg["message"] = "Account is verified. You can now login.";
                $msg['verified'] = "True";
                $msg['user'] = $user;
                $msg['token'] = 'Bearer ' . $token;
                $msg['token_type'] = 'bearer';
                $msg['expires_in(minutes)'] = (int)auth()->factory()->getTTL();
                $msg['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
                $msg['image_round_format']  = 'w_200,c_fill,ar_1:1,g_auto,r_max/';
                $msg['image_square_format'] = 'w_200,ar_1:1,c_fill,g_auto/';
                $msg['image_example_link']  = 'https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/noimage.jpg';

                return response()->json($msg, 200);


        } else{

            $msg["message"] = "Account with code does not exist!";

            return response()->json($msg, 404);

        }
            
        
    }
}
