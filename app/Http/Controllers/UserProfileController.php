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
    }

    public function all() {

    }

    public function role() {

    }

    public function update() {

    }
    
    public function destroy() {

    }
}
