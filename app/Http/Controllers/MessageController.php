<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function conversation($other_user_id) {
        // Conversations for the current user
        if (Auth::check()) {
            $user_id = Auth::id();
            
            $_sent = ['sender_id' => $user_id, 'receiver_id' => $other_user_id];
            $_received= ['sender_id' => $other_user_id, 'receiver_id' => $user_id];
            
            $sent_msgs = $received_msgs = "";
            $sent_msgs = Message::where($_sent)->get();
            $received_msgs = Message::where($_received)->get();
    
            $res = array();
            if(!$sent_msgs->isEmpty() || !$received_msgs->isEmpty()) {
                $res['sent'] = $sent_msgs;
                $res['received'] = $received_msgs;
                $res['message'] = "Retrieved conversation(s)";
                $res['status'] = 200;
            } else {
                $res['message'] = "No conversation found between users";
                $res['status'] = 200;
            }
        } else {
            $res['message'] = "User not logged in";
            $res['status'] = 401;
        }
        return response()->json($res, $res['status']);        
    }

    public function saveMessage(Request $request) {
        if (Auth::check()) {
            $res = array();
            try{
                Message::create([
                    'sender_id'     => Auth::id(),
                    'receiver_id'     => $request->input('receiver_id'),
                    'message'    => $request->input('message'),
                    'read' => 0
                ]);
    
                DB::commit();
                $res['message'] = 'Message sent';
                
                $res['status'] = 201;
            } catch(\Exception $e) {
                DB::rollBack();

                $res['message'] = "Error sending message! $e";
                $res['status'] = 501;
            }
        }  else {
            $res['message'] = "User not logged in";
            $res['status'] = 401;
        }
        
        return response()->json($res, $res['status']);
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
