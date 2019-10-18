<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{

    public function fetchnotifications()
    {

    	 if (Auth::check()) {
            $user_id = Auth::id();
    	 $matchThese = ['gateman_id' => $user_id];
    	 $orThose = [ 'visitor_id' => $user_id];
         $notifications = Notification::where($matchThese)->orWhere($orThose)->get();


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
