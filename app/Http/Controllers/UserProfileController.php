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
        $users = User::all();

        return response()->json($users);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function role($role_id) {

        // $users = User::where('role', $role);
        $users = DB::table('users')->select('*')->where('user.role', parseInt($role_id))->get();
        return response()->json($users);

    }

    public function update(Request $request) {
        $user = Auth::user();

        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->image    = $request->input('image');
        $user->password = Hash::make($request->input('password'));
        $user->phone    = $request->input('phone');

        $user->save();
        return response()->json($user);

    }

    public function destroy() {
        $user = Auth::user();
        $user->delete();

        $reponse = array('response' => 'Item deleted', 'success' => true);
        return json($response);
    }
}
