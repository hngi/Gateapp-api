<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\QrCodeGenerator;
use App\Http\Controllers\ImageController;
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
    //Please dont write here again this just a sample of how you will use this code in your controller
    //the code is generated from the backend and not requested from anyway Thank you
    public function qrCode(QrCodeGenerator $qrCodeGenerator) {
        $randomToken = Str::random(6);
        $qr = $qrCodeGenerator->generateCode('gateapp'.$randomToken);
        $res['message'] = 'Copy the qr and insert into an image tag and scan the barcode with a barcode scanner app';
        $res['qr'] = $qr;
        return response()->json($res, 200);
    }

    //the method test the file (image) upload
    public function upload(Request $request, ImageController $image) {
        $this->validate($request, [
         'image' => "image|max:4000|required",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, );
        return response()->json($res, $res['status_code']);
    }
}
