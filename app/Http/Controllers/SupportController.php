<?php

namespace App\Http\Controllers;

use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class SupportController extends Controller
{
    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     =>  'required',
            'email'  =>  'required|email',
            'message' =>  'required'
        ]);



        if ($validator->fails()) {

            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
            $data = array(
                'name'      =>  $request->name,
                'email'     => $request->email,
                'message'   =>   $request->message
            );

            Mail::to('support@gateapp.com')->send(new SupportMail($data));
            return response()->json(['message' => 'Thanks for contacting us!']);
        }
    }
}
