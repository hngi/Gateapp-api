<?php

namespace App\Http\Controllers\EstateBills\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\ResidentBill;
use Carbon\Carbon;


class GetPaymentController extends Controller
{

     /**
     * Gets authenticated user's data
     *
     * @return App\User
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }
    //



    //Get Recent Payments 
    public function recentPayments(){
        //get logged in estate admin's estate id
        $estate_id = $this->user->home->estate_id;
       // dd($estate_id);
      
   // $residents = ResidentBill::with('scopeBillInfo')->get();

    $payments = ResidentBill::where('status', 1)->orderBy('updated_at', 'desc')->take(5)
    ->with(['scopeBillInfo' => function ($query) use ($estate_id) {
        $query->where('estate_id',  $estate_id);

    }])->get();
    if(!$payments){
        $msg['status'] = false;
        $msg['status_code'] = 404;
        $msg['message'] = 'No Payments Found';

    }else{
        $msg['status'] = true;
        $msg['status_code'] = 200;
        $msg['payments'] = $payments;
    }

    return response()->json($msg, $msg['status_code']);
    }

    public function monthlyPaymentSum(){
        $estate_id = $this->user->home->estate_id;
        $totalPayment = ResidentBill::where('status', 1)->whereBetween('updated_at', 
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->with(['scopeBillInfo' => function ($query) use ($estate_id) {
            $query->where('estate_id',  $estate_id);
    
        }])->get();

        if(!$totalPayment){
            $msg['status'] = false;
            $msg['status_code'] = 404;
            $msg['message'] = 'No Payments Found';

        }else{
            $msg['status'] = true;
            $msg['status_code'] = 200;
            $msg['total_payment_count'] = $totalPayment->count();
            $msg['totalPayment'] = $totalPayment->sum('amount');

        }

        return response()->json($msg, $msg['status_code']);

    }

    public function pendingPayment(){
        $estate_id = $this->user->home->estate_id;
        $pendingPayment = ResidentBill::where('status', 0)->whereBetween('updated_at', 
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->with(['scopeBillInfo' => function ($query) use ($estate_id) {
            $query->where('estate_id',  $estate_id);
    
        }])->get();

        if(!$pendingPayment){
            $msg['status'] = false;
            $msg['status_code'] = 404;
            $msg['message'] = 'No Payments Found';

        }else{
            $msg['status'] = true;
            $msg['status_code'] = 200;
            $msg['pending_payment_count'] = $pendingPayment->count();
            $msg['pending_payment_amount'] = $pendingPayment->sum('amount');

        }

        return response()->json($msg, $msg['status_code']);

    }
}
