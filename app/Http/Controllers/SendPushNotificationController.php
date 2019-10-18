<?php

namespace App\Http\Controllers;
use App\User;
use App\Visitor;
use App\Requests\FCMTokenRequest;
use Illuminate\Support\Facades\DB;
use App\Notification;
use Illuminate\Http\Request;

class SendPushNotificationController extends Controller
{
    /**
    * 
    * @var user
    * @var FCMToken
    */
    protected $user;
    protected $fcmToken;
    /**
    * Constructor
    * 
    * @param 
    */
    public function __construct(User $id, Notification $fcmToken)
    {
    $this->id = $id;     
    }
    /**
    * Functionality to send notification.
    * 
    */

    public function sendNotification(Request $request, $id)
    {
    $token = $fcmToken;
    $apns_ids = [];
    $responseData = [];
   

    // for Android
    $notifications = User::where([['user_type', ''],['idresident', $id]])->get();
    $visitor = User::query()->inRandomOrder()->first();
    //I used gateman here in place of residents as i was not able to pull any resident from database
    
    if(!$notifications->isEmpty()){
    define('API_SERVER_KEY', env('FCM_SECRET_KEY') );
    $msg = array
    (
    'title' => 'Notification',
    'body'  => 'Hello, Please note that Your visitor'. $visitor->name.' has arrived ',
    'click_action' => 'button', //action button here
    );
    $fields = array
    (
    'to'  => $token,
    'data'  => $msg,
    );
    $headers = array
    (
    'Authorization: key=' . API_SERVER_KEY,
    'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    if ($result === FALSE) 
    {
    die('FCM Send Error: ' . curl_error($ch));
    }

    $result = json_decode($result,true);

    $responseData['android'] =[
    "result" =>$result
    ];

    $res["status"] = true;
    $res["message"] = "Notification sent";
    $res["data"] = $fields;
    return response()->json($res, 200);
    curl_close( $ch );
    }else{
        $res["status"] = false;
        $res["message"] = "Not found";
        return response()->json($res, 404);
    }

    } 

  
    /**
    * Test notification.
    * 
    */

    public function testNotification(Request $request, $id)
    {
    $token = ['BLdb31ksncjfqT-M9gyEKaArsq4_7if5uyRBcHkxxCRwZP-TjTnlx-VtGJbkM7m69UyESKC9uF59IxGniCeyP68'];
    $responseData = [];
   

    // for Android
    $notifications = User::where([['user_type', 'resident'],['id', $id]])->get();
    $visitor = Visitor::query()->inRandomOrder()->first();
    //I used gateman here in place of residents as i was not able to pull any resident from database
    
    if(!$notifications->isEmpty()){
    define('API_SERVER_KEY', env('FCM_SECRET_KEY') );
    $msg = array
    (
    'title' => 'Notification',
    'body'  => 'Hello, Please note that Your visitor'. $visitor->name.' has arrived ',
    'click_action' => 'button', //action button here
    );
    $fields = array
    (
    'to'  => $token,
    'data'  => $msg,
    );
    $headers = array
    (
    'Authorization: key=' . API_SERVER_KEY,
    'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    if ($result === FALSE) 
    {
    die('FCM Send Error: ' . curl_error($ch));
    }

    $result = json_decode($result,true);

    $responseData['android'] =[
    "result" =>$result
    ];

    $res["status"] = true;
    $res["message"] = "Notification sent";
    $res["data"] = $fields;
    return response()->json($res, 200);
    curl_close( $ch );
    }else{
        $res["status"] = false;
        $res["message"] = "Not found";
        return response()->json($res, 404);
    }

    }
}