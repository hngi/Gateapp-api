<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
      //generate new password for the user
    public function generatedPassword()
    {
        return substr(md5(time()), 0, 6);
    }

    public function verify(Request $request, User $user) {

        $this->validate($request, [
            'verifycode'  => 'required|max:6',
            'device_id' => 'required'
        ]);

        $verifycode = $request->input('verifycode');
        $checkCode  = User::where('verifycode', $verifycode)->exists();

        if ($checkCode) {

            $user = User::where('verifycode', $verifycode)->first();

            $token = Auth::guard()->login($user);
        
            if ($user->email_verified_at == null){
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
                $msg['image_format'] = 'w_200,c_thumb,ar_4:4,g_face/';

                return response()->json($msg, 200);
                
            } else {
                $msg["message"] = "Account verified already. Please Login";
                $msg['note'] = 'please redirect to login page';
                $msg['verified'] = "Done";

                return response()->json($msg, 208);
             }

        } else{

            $msg["message"] = "Account with code does not exist!";

            return response()->json($msg, 404);

        }
            
        
    }
}
