<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    public function index() {
    	$user = Auth::user(); //this is you active user logged in
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

    public function update(Request $request) {  // update user information
        $user = Auth::user();           
        $this->validate($request, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|min:2|unique:users,email,'.$user->id,
            'phone' => 'required',
        ]);

        //start temporay transaction
        DB::beginTransaction();
        try{
            $user->first_name = $request->input('first_name');
            $user->last_name  = $request->input('last_name');
            $user->email     = $request->input('email');
            $user->phone     = $request->input('phone');
            $user->save();
            
            //if operation was successful save commit save to database
            DB::commit();
            $res['status']  = true;
            $res['user']    = $user;
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

    public function password(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'old_password'=> 'required|string',
            'password' => 'required|min:8|different:old_password|confirmed'
        ]);
         //start temporay transaction
        DB::beginTransaction();
        try{
                $user->password = Hash::make($request->input('password'));
                $user->save();

                 //if operation was successful save commit save to database
                DB::commit();
                $res['status'] = true;
                $res['message'] = 'Password Changed Successfully!';
                return response()->json($res, 200);
            }catch(\Exception $e) {

                //rollback what is saved
                DB::rollBack();
                $res['status'] = false;
                $res['message'] = 'Password Update unsuccessful: An error occured, please try again!';
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
}
