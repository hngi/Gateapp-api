<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\DB;

class NotifyController extends Controller
{
    public function index(){
       // var pusher = new Pusher('API_KEY_HERE', {
          //  encrypted: true
        //  });
    
          // Subscribe to the channel we specified in our Laravel Event
      ///    
    }
    public function fetchnotifications($user_id)
    {
        $notifications = Notification::find($user_id);
        if($notifications){
            $res["status"] = True;
            $res["message"] = "One User's notifications";
            $res["data"] = $notifications;
            return response()->json($res, 200);
        }else{

            $res["status"] = false;
            $res["message"] = "Not found";
            return response()->json($res, 404);
        }
    }


    

}
