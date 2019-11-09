<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ImageController;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\SmsOtpController;
use App\Mail\VerifyToken;
use Exception;
use App\Mail\EstateAdminPasswordRecovery;

class UserProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id; //this is you active user logged in
        $user = User::where('id', $user_id)
            ->with(['home' => function ($query) {
                $query->with('estate');
            }])
            ->first();
        return response()->json($user, 200);
    }

    public function all()
    {
        $super_admins = [];
        $residents = [];
        $gatemans = [];
        $estate_admins = [];

        $users = User::with(['home' => function ($query) {
            $query->with('estate');
        }])->get();

        foreach ($users as $user) {
            if ($user->role == 0) {
                array_push($super_admins, $user);
            } else if ($user->role == 1) {
                array_push($residents, $user);
            } else if ($user->role == 2) {
                array_push($gatemans, $user);
            }else if ($user->role == 3) {
                array_push($estate_admins, $user);
            }
        }
        $res['status']    = true;

        $res['residents'] = $residents;
        $res['gatemans']  = $gatemans;
        $res['estate_admins']  = $estate_admins;
        $res['super_admins']    = $super_admins;
        return response()->json($res, 200);
    }

    public function showOneAdmin($id)
    {
        $user = User::find($id);
        if ($user->role == 0 || $user->role == 3) {
            $res['status'] = true;
            $res['message'] = 'Admin found';
            $res['admin'] = $user;
            return response()->json($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = 'Admin not found';
            return response()->json($res, 404);
        }
    }

    public function showAllAdmin()
    {
       // $admins = [];
        $admins = User::where('role', '3')->with(['home' => function ($query) {
            $query->with('estate');
        }])->get();
       /* foreach ($users as $user) {
            if ($user->role == 0 || $user->role == 3) {
                array_push($admins, $user);
            }
        }*/
        if (!$admins) {
            $res['status']    = false;
            $res['message']    = "No Admin Found";
            return response()->json($res, 404);
        } else {

            $res['status']    = true;
            $res['admins']    = $admins;
            return response()->json($res, 200);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user->role == 1 || $user->role == 2) {
            $res['status'] = true;
            $res['message'] = 'User found';
            $res['user'] = $user;
            return response()->json($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = 'User not found';
            return response()->json($res, 404);
        }
    }


    public function role($role_id)
    {
        $users = User::where('role', $role_id)->get();
        return response()->json($users);
    }

    public function update(Request $request, ImageController $image, $id=null)
    {  // update user information
        if ($id != null) {
            $user = User::find($id);
        }else {
            $user = Auth::user();
        }

        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|unique:users,phone,' . $user->id,
            'username' => 'unique:users,username,' . $user->id,
            'email'    => 'nullable|unique:users,email,' . $user->id,
            'duty_time'    => 'string'
        ]);


        //start temporay transaction
        DB::beginTransaction();
        try {
            $user->name      = $request->input('name') ?? $user->name;
            $user->username  = $request->input('username') ?? $user->username;
            $user->email     = $request->input('email') ??  $user->email;
            $user->duty_time  = $request->input('duty_time') ?? $user->duty_time;

            $phone = $request->input('phone');
            if ($user->phone != $phone) {
                $user->email_verified_at = null;
                $user->verifycode = mt_rand(1000,9999);
                $user->phone      = $phone;

                 //Send sms otp to user
                 $phone     = $user->phone;
                 $message   = 'Use this 4 digit otp token to verify your new phone number '. $user->verifycode;
                 $smsOtpController = new SmsOtpController;
                 $smsOtpController->africasTalking($phone, $message);
                 $res['new_number'] = true;
                $res['important'] = 'An otp token has ben sent to you phone because you changed your phone number!';
            }
            //Upload image
            $data = null;
            if ($request->hasFile('image')) {
                $data = $this->upload($request, $image, $user);
                if ($data['status_code'] !=  200) {
                    return response()->json($data, $data['status_code']);
                }
                $user->image = $data['image'];
            }


            $user->save();

            //if operation was successful save commit save to database
            DB::commit();
            $res['status']  = true;
            $res['user']    = $user;
            $res['image_info']   = $data;
            $res['message'] = 'Your Account Was Successfully Updated';

            return response()->json($res, 200);
        } catch (\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An Error Occured While Trying To Update Your Account Information';
            $res['hint'] = $e->getMessage();

            return response()->json($res, 501);
        }
    }



    public function destroy($id=null)
    {
        if ($id != null) {
            $user = User::find($id);
        }else {
            $user = Auth::user();
        }

        if ($user) {         // removes user account
            $user->delete();
            $res['message'] = 'User deleted successfully';
            return response()->json($res, 200);
        } else {
            $res['message'] = 'User unsuccessfully, user not found or an error occured, please try again!';
            return response()->json($res, 501);
        }
    }



    public function upload($request, $image)
    {
        $user = Auth::user();

        $this->validate($request, [
            'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $user);
        return $res;
    }

    /**
     * Manage User's settings
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function manageSettings(Request $request)
    {
        $data = [
            'app_notification' => $request->filled('app_notification'),
            'push_notification' => $request->filled('push_notification'),
            'location_tracking' => $request->filled('location_tracking'),
        ];

        DB::beginTransaction();

        try {

            $user = \auth()->user();

            if ($user->settings) {
                // remove items not filled in the request
                array_walk($data, function ($item, $key) use (&$data) {
                    if ($item == false) unset($data[$key]);
                });

                $user->settings()->update($data);
            } else {
                $user->settings()->create($data);
            }

            $data['user_id'] = $user->id;

            DB::commit();

            return response()->json(['message' => 'Settings updated.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "An error occurred while updating your  settings",
                'hint' => $e->getMessage(),
            ], 501);
        }
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => ['string', 'nullable']
        ]);


        try {
            $user = Auth::user();
            DB::beginTransaction();
            // auth()->user()->update(['fcm_token' => $request->fcm_token]);
            $user->fcm_token = $request->fcm_token;
            $user->save();
            //if operation was successful save commit save to database
            DB::commit();
            return response()->json(['message' => 'Firebase token updated']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 501);
        }
    }
     //revoke selected admin access
    public function revokeAdmin($id)
    {
        $user = User::where('id', $id)->where('access', 1)->first();
            if(!$user){
            $res['status'] = 404;
            $res['message'] = 'User not found or users access is already revoked';
            //return response()->json($res, 401);
            }else
            if($user->role == 3){
            User::where('id', $id)->update(['access' => 0]);
            $res['status'] = 200;
            $res['user'] = $user;
            $res['message'] = "Successfully block admin from access";
        }else {
            $res['status'] = 402;
            $res['message'] = 'user you are trying to block is not an Admin or an error occured, please try again!';
            //return response()->json($res, 402);
        }

        return response()->json($res, $res['status']);
    }

    //unblock selected admin access
    public function unrevokeAdmin($id)
    {
            $user = User::where('id', $id)->where('access', 0)->first();
            if(!$user){
            $res['status'] = 404;
            $res['message'] = 'User not found or User has full access!';
           // return response()->json($res, $res['status']);
            }else
            if($user->role == 3){
            User::where('id', $id)->update(['access' => 1]);

            $res['status'] = 200;
            $res['admin'] = $user;
            $res['message'] = "Successfully unblock admin";
        }else {
            $res['status'] = 402;
            $res['message'] = 'user you are trying to unblock is not an Admin or an error occured, please try again!';
           // return response()->json($res, $res['status']);
        }

        return response()->json($res, $res['status']);
    }

    public function resetAdmin($id)
    {
       // $res = array();
      //  $this->validateRequest($request);

        DB::beginTransaction();

       //try {
            $EstateAdmin = User::where('id', $id)->where('role', '3')->with(['home' => function ($query) {
                $query->with('estate');
            }])->first();



            if ($EstateAdmin) {
                $estateName = $EstateAdmin->home->estate->estate_name;
                $adminEmail = $EstateAdmin->email;
                $password   = Str::random(10);
                $EstateAdmin->password = Hash::make($password);
                $EstateAdmin->save();

               DB::commit();
                Mail::to($adminEmail)->send(new EstateAdminPasswordRecovery($EstateAdmin, $password, $estateName ));
                $res['status'] = 200;
                $res['message'] = "Password reset successful! A mail with the admin's new password has been sent to thier email";
                $res['data'] = $EstateAdmin;

            } else {
                $res['status'] = 404;
                $res['message'] = "Admin not found";
            }
      /*  } catch(\Exception $e) {
            DB::rollBack();

            $res['status'] = 501;
            $res['message'] = "An error occured trying to reset admin password";
        }*/

        return response()->json($res, $res['status']);
    }
    public function validateRequest(Request $request){
        $rules = [
            'password'  => 'required|min:8'
        ];
        $messages = [
            'required' => ':attribute is required and most be a min of 8'
        ];
    $this->validate($request, $rules, $messages);
  }
}
