<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeGenerator extends Controller
{
    public function generateCode()
    {
    	return view('qrcode');
    }
}
