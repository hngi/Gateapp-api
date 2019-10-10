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
        return response()->json($user);
    }

    //This is temporary to allow me test since the register was working on my system
    public function create(Request $request) {
        $verifycode = Str::random(6);

        DB::beginTransaction();

        try{
           $user = User::create([
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'image'    => 'no_image.jpg',
                'password' => Hash::make($request->input('password')),
                'phone'    => $request->input('phone'),
                'role'     => 1,
                'verifycode' => $verifycode
            ]);

            $msg['message'] = 'Account created successfully';
            $msg['message-2'] = 'A verification code has been sent to your email, please use to veriify your account, also check your spam folder for email';
            $msg['user']    = $user;

            //Send a mail form account verification
            // Mail::to($user->email)->send(new WelcomeMail($user));
            //if operation was successful save commit save to database
            DB::commit();
            $msg['status'] = 201;
            // return $msg;
            return response()->json($msg);


        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $msg['error'] = "Error: Account not created, please try again!";
            $msg['hint'] = $e->getMessage();
            $msg['status'] = 501;
            // return $msg;
            return response()->json($msg);
        }

    }

    public function all() {
        $users = User::all();

        return response()->json($users);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function role($role) {

        // $users = User::where('role', $role);
        $users = DB::table('users')->select('*')->where('user.role', parseInt($role))->get();
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
        return $response;
    }
}
