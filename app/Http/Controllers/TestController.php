<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\QrCodeGenerator;
use Illuminate\Support\Str;
use App\User;

class TestController extends Controller
{
    //
    public function test(Request $request) {

    	$users = User::all();

    	$res['message'] = 'All users';
    	$res['users'] = $users;
    	return response()->json($res, 200);

    }

    //testing the qr code generator
    //this is how to use the qr code on another controller and return a data url image code
    public function qrCode(QrCodeGenerator $qrCodeGenerator) {
        //Generate a random token
        $randomToken = Str::random(6);
        $qr = $qrCodeGenerator->generateCode('gateapp'.$randomToken);
        $res['message'] = 'Copy the qr and insert into an image tag and scan the barcode with a barcode scanner app';
        $res['qr'] = $qr;
        return response($res, 200);
    }
}
