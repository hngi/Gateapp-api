<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function index(){
       // var pusher = new Pusher('API_KEY_HERE', {
          //  encrypted: true
        //  });
    
          // Subscribe to the channel we specified in our Laravel Event
      ///    
    }
    public function fetchnotifications()
    {
       if (Auth::check()) {
            $user_id = Auth::id();
    	 $matchThese = ['notifiable_id' => $user_id];
    	
         $notifications = Notification::where($matchThese)->get();


        if(!$notifications->isEmpty()){
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



}
