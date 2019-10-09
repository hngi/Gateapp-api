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

    public function role() {

    }

    public function update(Request $request) { 
        $this->validate($request, [
        'firstname' => 'required|min:2',
        'lastname' => 'required|min:2',
        'email' => 'required|min:2|unique:users',
        'phone_no' => 'required',
    ]);
    
    if(!empty(request()->input('firstname')) && !empty(request()->input('lastname')) && !empty(request()->input('email')) && !empty(request()->input('phone_no')))
    {
    $user = User::findOrFail(Auth::user()->id);
    $user->firstname = request()->input('firstname');
    $user->email = request()->input('email');
    $user->lastname = request()->input('lastname');
    $user->phone_no = request()->input('phone_no');
    $user->save();
    
    
    $res['status'] = true;
    $res['message'] = 'Your Account Was Successfully Updated.';
    return response()->json($res, 200);
    }
     else
    {
    $res['status'] = false;
    $res['message'] = 'An Error Occured While Trying To Update Your Account Information.';
    return response()->json($res, 500);
    }
   }
    
    public function destroy() {

    }
}
