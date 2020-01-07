<?php

namespace App\Http\Controllers\EstateBills\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProofOfPayment;
use App\ResidentBill;
use App\Home;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProofOfPaymentController extends Controller
{
    //
    public function showAll(){
       $user = Auth::user(); 
       $user_id = $user->id;
       $estate_id = Home::where('user_id', $user_id)->value('estate_id');

       // Get all Proof of payment for signed in Estate Admin's Estate 
       $paymentProofs = ProofOfPayment::where('estate_id', $estate_id)->get();

       if(!$paymentProofs){
           return response()-> json([
               'status' => false,
               'message' => 'No Proof of payment has been submitted'
           ]);
       }else{
           return response()-> json([
               'status' => true, 
               'count' => $paymentProofs->count(),
               'paymentProofs' => $paymentProofs,
           ]);

       }

    } 
}
