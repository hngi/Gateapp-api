<?php

namespace App\Http\Controllers\EstateBills\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProofOfPayment;
use App\ResidentBill;
use App\Home;
use App\Http\Resources\Resident;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProofOfPaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function showAll(){
        
       $user_id = $this->user->id;
       $estate_id = Home::where('user_id', $user_id)->value('estate_id');

       // Get all Proof of payment for signed in Estate Admin's Estate 
       $ProofOfPayment = ProofOfPayment::where('estate_id', $estate_id)->get();

       if(!$ProofOfPayment){
           return response()-> json([
               'status' => false,
               'message' => 'No Proof of payment has been submitted'
           ], 404);
       }else{
           return response()-> json([
               'status' => true, 
               'count' => $ProofOfPayment->count(),
               'proofOfPayment' => $ProofOfPayment,
           ], 200);

       }

    }

    public function viewProof($proof_id) {
        $user_id = $this->user->id;
       $estate_id = Home::where('user_id', $user_id)->value('estate_id');

       // Get all Proof of payment for signed in Estate Admin's Estate 
       $ProofOfPayment = ProofOfPayment::where('estate_id', $estate_id)->where('id', $proof_id)->find($proof_id);

       if(!$ProofOfPayment){
           return response()-> json([
               'status' => false, 
               'message' => 'Error: Selected Proof of payment doesnt exist',
           ], 404);
       }
       else{
           return response()-> json([
               'status' => true,
               'proofOfPayment' => $ProofOfPayment,
           ], 200);
       }

    }

    public function verifyPayment($proof_id){

        $ProofOfPayment = ProofOfPayment::where('status', 0)->find($proof_id);
        $resident_bill_id = ProofOfPayment::where('id', $proof_id)->pluck('resident_bills_id'); 
      
        try{
           
            if(!$ProofOfPayment){
                
                return response()->json([
                    'status' => false,
                    'message' => 'Payment already verified or an error occured'

                ], 404);


            }else{
                $ProofOfPayment->update(['status' => 1]);
                ResidentBill::where('id', $resident_bill_id )->update(['status' => 1]);
                return response()->json([
                    'status' => true,
                    'message' => 'Payment Verified Successfully',
                    

                ], 200);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }

    }

    public function queryPayment($proof_id, Request $request){

        $ProofOfPayment = ProofOfPayment::where('status', 0)->find($proof_id);
       
        try{
           
            if(!$ProofOfPayment){
                
                return response()->json([
                    'status' => false,
                    'message' => 'Payment already verified or an payment proof does not exist'

                ], 404);


            }else{
               // Add notification to the resident with the message sent by estate Admin here 
                $message = $request->input('message');



                return response()->json([
                    'status' => true,
                    'message' => 'Resident has been notified of issue with the payment',
                    'admin_message' => $message,
                ], 200);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }

    }
}
