<?php

namespace App\Http\Controllers;

use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Support;

class SupportController extends Controller
{
    public function index()
    {
        $support = Support::all();
        return response()->json($support);
    }
    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'  =>  'required|email',
            'subject'     =>  'required',
            'message' =>  'required'
        ]);

        if ($validator->fails()) {

            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
            $data = array(
                'email'     => $request->email,
                'subject'      =>  $request->subject,
                'message'   =>   $request->message
            );
            Support::create($data);
            Mail::to('support@gateapp.com')->send(new SupportMail($data));
            return response()->json(['message' => 'Thanks for contacting us!']);
        }
    }

    public function show($id)
    {
        $support = Support::where('id', $id)->first();

        return response()->json(['message' => 'One support message', 'support' => $support]);
    }
    public function destroy($id)
    {
        $support = Support::where('id', $id)->first();
        $support->delete();
        return response()->json(['message' => 'Support Message was successfully deleted']);
    }
}
