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
    //

    public function index() {
    	$user = Auth::user(); //this is you active user logged in
    	// dd($user); use this to break and check your code

        $res['user'] = $user;
        return response()->json($res, 200);
    }

    public function all() {

    }

    public function role($id) {
        //fetch all user base on role
    }

    public function update(Request $request) { 
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
            $res['message'] = 'Your Account Was Successfully Updated.';

            return response()->json($res, 200);

        }catch(\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An Error Occured While Trying To Update Your Account Information.';
            $res['hint'] = $e->getMessage();

            return response()->json($res, 501);

        }
   }
    
    public function destroy() {

    }
}
