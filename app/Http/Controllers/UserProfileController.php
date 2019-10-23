<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ImageController;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\VerifyToken;

class UserProfileController extends Controller
{
    public function index() {
    	$user_id = Auth::user()->id; //this is you active user logged in
        $user = User::where('id', $user_id)
                      ->with(['home' => function($query){
                            $query->with('estate');
                         }])
                      ->first();
        return response()->json($user, 200);
    }

    public function all() {
        $admins = [];
        $residents = [];
        $gatemans = [];

        $users = User::all();
        foreach ($users as $user) {
            if($user->role == 0) {      
                array_push($admins, $user);
            }else if($user->role == 1){     
                array_push($residents, $user);
            }else if($user->role == 2) {    
                array_push($gatemans, $user);
            }
        }
        $res['status']    = true;
        $res['admins']    = $admins;
        $res['residents'] = $residents;
        $res['gatemans']  = $gatemans;
        return response()->json($res, 200);
    }

    public function showOneAdmin($id) {
        $user = User::find($id); 
        if($user->role == 0) {      
            $res['status'] = true;
            $res['message'] = 'Admin found';
            $res['admin'] = $user;
            return response()->json($res, 200);
        }else {
            $res['status'] = false;
            $res['message'] = 'Admin not found';
            return response()->json($res, 404);
        }
    }

    public function show($id) { 
        $user = User::find($id);
        if($user->role == 1 || $user->role == 2) { // condition statements shows specific resident or gate man users except admin by id
            $res['status'] = true;
            $res['message'] = 'User found';
            $res['user'] = $user;
            return response()->json($res, 200);
        }else {
            $res['status'] = false;
            $res['message'] = 'User not found';
            return response()->json($res, 404);
        }
    }


    public function role($role_id) {
        $users = User::where('role', $role_id)->get();
        return response()->json($users);

    }

    public function update(Request $request, ImageController $image) {  // update user information
        $user = Auth::user();           
        $this->validate($request, [
            'name' => 'required|min:2',
            'phone' => 'required|min:2|unique:users,phone,'.$user->id,
            'username' => 'min:2|unique:users,username,'.$user->id,
            'email' => 'min:2|unique:users,email,'.$user->id,
        ]);
        
        //start temporay transaction
        DB::beginTransaction();
        try{
            $user->name      = $request->input('name');
            $user->username  = $request->input('username');
            $user->email     = $request->input('email');
            if($user->phone != $request->input('phone')){
                $user->email_verified_at = null;
                $user->verifycode = Str::random(6);
                $user->phone     = $request->input('phone');
                 //We use mail for now untill sms is implemented
                 Mail::to($user->email)->send(new VerifyToken($user));
                $res['important'] = 'A six digit OTP token has ben sent to you email or phone because this phone number is new!';
             }
            //Upload image 
             //Upload image 
             if($request->hasFile('image')) {
                $data = $this->upload($request, $image);
                if($data['status_code'] !=  200) {
                    return response()->json($data, $data['status_code']);
                }
                $user->image = $data['image'];
            }else {
                $data = null;
                $user->image = 'noimage.jpg';
            }


            $user->save();
            
            //if operation was successful save commit save to database
            DB::commit();
            $res['status']  = true;
            $res['user']    = $user;
            $res['image_info']   = $data;
            $res['message'] = 'Your Account Was Successfully Updated';

            return response()->json($res, 200);

        }catch(\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An Error Occured While Trying To Update Your Account Information';
            $res['hint'] = $e->getMessage();

            return response()->json($res, 501);

        }
   }

    public function destroy() {
        $user = Auth::user();
        if($user) {         // removes user account
            $user->delete();
            $res['message'] = 'User deleted successfully';
            return response()->json($res, 200);
        }else {
            $res['message'] = 'User unsuccessfully, user not found or an error occured, please try again!';
            return response()->json($res, 501);
        }
    }
    
    public function upload($request, $image) {
        $user = Auth::user();

        $this->validate($request, [
         'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $user);
        return $res;
    }
}
