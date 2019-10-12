<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\User;
use Notification;
use App\Notifications\PaymentNotification;
  
class PaymentController extends Controller
{

    public function index()
    {
        return view('home');
    }
  
    public function sendNotification()
    {
        $user = User::first();
  
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is your payment notification from GatePass.com',
            'thanks' => 'Thank you for using for makiing your payment!',
            'actionText' => 'View Our Residents',
            'actionURL' => url('/'),
            'order_id' => 101
        ];
  
        Notification::send($user, new PaymentNotification($details));
   
        dd('done');
    }
  
}
