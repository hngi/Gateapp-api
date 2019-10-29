<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visitor;
use Carbon\Carbon;

class VisitorStatsController extends Controller
{
    //Get total number of registered visits on the system 

    public function index(){
        $totalVisits = Visitor::count();
        if (!$totalVisits){
            $res['status']  = false;
            $res['message'] = 'No Visits found';
            return response()->json($res, 404); 
        }
        else{
            $res['status']  = true;
            $res['message'] = 'Total Number of Visits';
            $res['Service Providers'] = $totalVisits;
            return response()->json($res, 200);
        }

    }

    public function weeklyVisits(){

        $totalVisits = Visitor::whereBetween('arrival_date', 
        [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        if (!$totalVisits){
            $res['status']  = false;
            $res['message'] = 'No Visits Scheduled for this week';
            return response()->json($res, 404); 
        }
        else{
            $res['status']  = true;
            $res['message'] = 'Total Number of Visits Scheduled for this week';
            $res['Service Providers'] = $totalVisits;
            return response()->json($res, 200);
        }

    }

    public function monthlyVisits(){

        $totalVisits = Visitor::whereBetween('arrival_date', 
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
        if (!$totalVisits){
            $res['status']  = false;
            $res['message'] = 'No Visits Scheduled for this Month';
            return response()->json($res, 404); 
        }
        else{
            $res['status']  = true;
            $res['message'] = 'Total Number of Visits Scheduled for this Month';
            $res['Service Providers'] = $totalVisits;
            return response()->json($res, 200);
        }

    }

    public function annualVisits(){

        $totalVisits = Visitor::whereBetween('arrival_date', 
        [Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->count();
        if (!$totalVisits){
            $res['status']  = false;
            $res['message'] = 'No Visits Scheduled for this Year';
            return response()->json($res, 404); 
        }
        else{
            $res['status']  = true;
            $res['message'] = 'Total Number of Visits Scheduled for this Year';
            $res['Service Providers'] = $totalVisits;
            return response()->json($res, 200);
        }

    }
/* 
Get total number of Visits scheduled in a specific estate 


*/

}
