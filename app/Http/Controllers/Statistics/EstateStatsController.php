<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Estate;
use App\Home;
use Carbon\Carbon;
use App\Http\Resources\Estate as AppEstate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EstateStatsController extends Controller
{
    /***
     * 
     * This method returns the total number of estates on the system for the super admin route since Inception 
     * 
     * */

    public function index(){
    
        $totalEstates = Estate::count();
            
            if (!$totalEstates){
                $res['status']  = false;
                $res['message'] = 'No Estates found';
                return response()->json($res, 404); 
            }else {
                $res['status']  = true;
                $res['message'] = 'Total Number of Estates ';
                $res['Estates'] = $totalEstates;
                return response()->json($res, 200);
            }

    }


    /** Show  total number of Estates Added this year ***/
    public function showYear(){
       
            $totalEstates = Estate::whereBetween('created_at', 
            [Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->count();
            
            if (!$totalEstates){
                $res['status']  = false;
                $res['message'] = 'No Estates have been added this year';
                return response()->json($res, 404); 
            }else {
                $res['status']  = true;
                $res['message'] = 'Total Number of Estates added this year ';
                $res['Estates'] = $totalEstates;
                return response()->json($res, 200);
            }

    }

    /** Show  total number of Estates Added this Month ***/
    public function showMonth(){
       
            $totalEstates = Estate::whereBetween('created_at',
             [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
            
            if (!$totalEstates){
                $res['status']  = false;
                $res['message'] = 'No Estates have been added this month';
                
                return response()->json($res, 404); 
            }else {
                $res['status']  = true;
                $res['message'] = 'Total Number of Estates Added this month';
                $res['Estates'] = $totalEstates;
                return response()->json($res, 200);
            }
    }

    // Week 

    public function showWeek(){

     $totalEstates = Estate::whereBetween('created_at', 
     [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
            
            if (!$totalEstates){
                $res['status']  = false;
                $res['message'] = 'No Estates found';
                return response()->json($res, 404); 
            }else {
                $res['status']  = true;
                $res['message'] = 'Total Number of Estates added this week';
                $res['Estates'] = $totalEstates;
                return response()->json($res, 200);
            }

    }
}
