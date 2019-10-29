<?php

namespace App\Http\Controllers\EstateAdmin;

use App\Http\Controllers\Controller;
use App\User;
use App\Home;
use App\Estate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\EstateAdminVerify;

class RegistrationController extends Controller
{
    public function create(Request $request, Home $home, User $user)
    {
        $this->validateRequest($request);
        $verifycode = mt_rand(1000,9999);
        $password   = Str::random(10);
        
        //start temporay transaction
        DB::beginTransaction();
        try{
            $user->image      = 'noimage.jpg';
            $user->email      = $request->input('email');
            $user->password   = Hash::make($password);
            $user->user_type  = 'estate_admin';
            $user->role       = '3';
            $user->verifycode = $verifycode;
            $user->save();
            //Insert into admin estate
            $result = $this->insertEsate($request, $home, $user, $request->input('estate_id'));
            if($result){
                $estate = Estate::where('id', $request->input('estate_id'))->first();
            }
            $msg['status'] = 201;
            $msg['app-hint'] = 'This is a new estate admin!';

            Mail::to($user->email)->send(new EstateAdminVerify($user, $password, $estate));
            $msg['message']    = 'A password to login has been sent to this email, please do well to check!';
            $msg['user']       = $user;
            $msg['estate']     = $estate;
            $msg['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
            $msg['image_round_format']  = 'w_200,c_fill,ar_1:1,g_auto,r_max/';
            $msg['image_square_format'] = 'w_200,ar_1:1,c_fill,g_auto/';
            $msg['image_example_link']  = 'https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/noimage.jpg';


            DB::commit();
            return $msg;

        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $res['message'] = "Error: Account not created, please try again!";
            $res['hint'] = $e->getMessage();
            $res['status'] = 501;
            return $res;
        }
    }

    public function insertEsate($request, $home, $user, $estate_id) {
            $home->user_id   = $user->id;
            $home->estate_id = $estate_id;
            $home->save();
            return true;
    }

    public function validateRequest(Request $request){
            $rules = [
                'email'     => 'required|email|unique:users',
                'estate_id'=> 'required'
            ];
            $messages = [
                'required' => ':attribute is required',
            ];
        $this->validate($request, $rules, $messages);
    }
}
