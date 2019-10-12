<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function conversation($other_user_id) {
        // To get the currently connected user's id
        $user = Auth::user();
        $user_id = $user->id;
        
    	$_sent = ['sender_id' => $user_id, 'receiver_id' => $other_user_id];
        $_received= ['sender_id' => $other_user_id, 'receiver_id' => $user_id];
        
        $sent_msgs = $received_msgs = "";
        $sent_msgs = Message::where($_sent)->get();
        $received_msgs = Message::where($_received)->get();

        if($sent_msgs || $received_msgs) {
            $res['sent'] = $sent_msgs;
            $res['received'] = $received_msgs;
            return response()->json($res, 200);
        }
        
    }

    public function saveMessage(Request $request) {
        try{
            $msg = Message::create([
                'sender_id'     => $request->input('sender_id'),
                'receiver_id'     => $request->input('receiver_id'),
                'message'    => $request->input('message'),
                'read' => 0
            ]);
 
            DB::commit();
            $res['message'] = 'Message sent';
            
            $res['status'] = 201;
            return $res; 
        } catch(\Exception $e) {
            DB::rollBack();

            $res['message'] = "Error sending message! $e";
            $res['status'] = 501;
            return $res;
        }
    }

    public function validateRequest(Request $request){
        $rules = [
            'sender_id'    => 'required|integer',
            'receiver_id'     => 'required|integer',
            'message'     => 'required|string'
        ];
        $messages = [
            'required' => ':attribute is required'
        ];
    $this->validate($request, $rules, $messages);
}
}
