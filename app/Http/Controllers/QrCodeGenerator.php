<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//check the test controller to see how it is been used

class QrCodeGenerator extends Controller
{
	//This class generate the data base 64 image for qr code
	//call this class anywhere qr cpde is to be generated 
    public function generateCode($token)
    {
    	$qr = 'data:image/png;base64,'.base64_encode(QrCode::format('png')->size(100)->generate($token));
    	return $qr;
    }

    public function testCode() {

    	$qr = $this->generateCode('gateapp');
    	$res['message'] = 'Copy the qr and insert into an image tag in html or xml to test!';
        $res['qr'] = $qr;
    	return response($res, 200);
    }
}
