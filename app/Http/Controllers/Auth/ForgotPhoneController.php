<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NewPassword;

use App\User;

class ForgotPasswordController extends Controller
{
    //generate verify code for the user
    public function generatedCode()
    {
         return Str::random(6);
    }


    public function verifyPassword(Request $request)
    {

    // Do a validation for the input
        $this->validate($request, [
            'old_phone' => 'required',
            'new_phone' => 'required',
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
            //generate a new verify code 
            $user->phone      = $request->input('new_phone');
            $user->verifycode = $this->generatedCode();
            $user->save();

            //Send Sms to new phone number
            // Mail::to($user->email)->send(new NewPassword($user));
            //Commit changes 
            DB::commit();

            $res['success'] = true;
            $res['message'] = 'OTP token has been sent. Please check your phone to verify account!';
            return response()->json($res, 200);
          } catch (\Exception $e) {

            //Rollback if there is an erro
             DB::rollBack();
             $res['success'] = false;
             $res['message'] = 'OTP Token not sent. Please try again!';
             return response()->json($res, 501);
          }
    }

}
