<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;
// use App\Mail\NewPassword;
// use App\User;

// class ResetPhoneController extends Controller
// {
//      /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     //generate verify code for the user
//     public function generatedPassword()
//     {
//        return Str::random(6);
//     }

//     public function reset(Request $request)
//     {

//     // Do a validation for the input
//         $this->validate($request, [
//             'verifycode' => 'required|max:6|min:5',
//             'device_id' => 'required|string'
//         ]);

//         $user = User::where('verifycode', $request->input('verifycode'))->first();

//        if ($user == null)
//        {
//           $res['success'] = false;
//           $res['message'] = 'Verification code does not exist or device not recognize, please try again!';
//           return response()->json($res, 401);
//        }else{
//          //start temporay transaction
//          DB::beginTransaction();
//         try{
//             //Save to Database
//             $user->email_verified_at = date("Y-m-d H:i:s");
//             $user->verifycode = $this->generatedPassword();
//             $user->device_id  = $request->input('device_id');
//             $user->save();

//             $token = Auth::guard()->login($user);  
//             //Commit changes
//             DB::commit(); 
//             $res['success'] = true;
//             $msg['message'] = 'Your phone number has been confirmed!';
//             $msg['verified'] = "True";
//             $msg['user'] = $user;
//             $msg['token'] = 'Bearer ' . $token;
//             $msg['token_type'] = 'bearer';
//             $msg['expires_in(minutes)'] = (int)auth()->factory()->getTTL();
//             $msg['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
//             $msg['image_format'] = 'w_200,c_thumb,ar_4:4,g_face/';

//             return response()->json($msg, 200);
//           } catch (\Exception $e) {

//              //Rollback if error
//              DB::rollBack();
//              $res['success'] = false;
//              $res['message'] = 'An error occured: please try again!';
//              return response()->json($res, 501);
//           }
//        }
//     }
// }
