<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

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
       
        $user = auth()->user();
        $notifications = $user->notifications;

    
        $res["data"] = $notifications;
        return response()->json($res, 200);
        
    }
    public function markread($id){
      $notification = DatabaseNotification::where('id', $id)->where('notifiable_id:', auth()->user()->id)->first();
      $notification->markAsRead();
    }
    public function delete($id){
       $notification = DatabaseNotification::where('id', $id)->where('notifiable_id:', auth()->user()->id)->first();
      $user->notifications()->delete();
    }





}
