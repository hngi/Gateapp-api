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

// class ResetPasswordController extends Controller
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
//             ''   => 'required|min:8|confirmed',
//         ]);

//         $verifycode = $request->input('verifycode');
//         $password   = $request->input('password');

//         $user = User::where('verifycode', $verifycode)->first();

//        if ($user == null)
//        {
//           $res['success'] = false;
//           $res['message'] = 'Verification code does not exist, please try again!';
//           return response()->json($res, 401);
//        }else{
//          //start temporay transaction
//          DB::beginTransaction();
//         try{
//             //Save to Database
//             $user->password   = Hash::make($password);
//             $user->verifycode = $this->generatedPassword();
//             $user->save();

//             //Commit changes
//             DB::commit();

//             $res['success'] = true;
//             $res['message'] = 'Your password has been changed successfully!';
//             return response()->json($res, 200);

//           } catch (\Exception $e) {

//              //Rollback if error
//              DB::rollBack();
//              $res['success'] = false;
//              $res['message'] = 'An error occured: password not changed, please try again!';
//              return response()->json($res, 501);
//           }
//        }
//     }
// }
