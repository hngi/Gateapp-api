<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TestController extends Controller
{
    //

    public function test(Request $request) {

    	$this->validate($request, [
            'verifycode' => 'required|max:6|min:5',
            'password'   => 'required|min:8',
        ]);

    	$users = User::all();

    	$res['message'] = 'All users';
    	$res['users'] = $users;
    	return response()->json($res, 200);

    }
}
