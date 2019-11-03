<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visitor;
use Carbon\Carbon;
use App\ScheduledVisit;

class VisitorStatsController extends Controller
{
    //Get total number of registered visits on the system 

    public function index(){
        $totalVisits = Visitor::sum('visit_count');
        if ($totalVisits){
            $res['status']  = 'all';
            $res['message'] = 'Total Number of Visits';
            $res['Service Providers'] = $totalVisits;
            $res['code']   = 'vist_all';
            return response()->json($res, 200);
        }

    }

    public function weeklyVisits(){

        $totalVisits = ScheduledVisit::whereBetween('created_at', 
        [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
           $res['status']  = 'wkly';
            $res['message'] = 'Total Number of Visits Scheduled for this week';
            $res['Visits'] = $totalVisits;
            $res['code']   = 'vist_wkly';
            return response()->json($res, 200);

    }

    public function monthlyVisits(){

        $totalVisits = ScheduledVisit::whereBetween('created_at', 
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
           $res['status']  = 'mnthly';
            $res['message'] = 'Total Number of Visits Scheduled for this Month';
            $res['Visits'] = $totalVisits;
            $res['code']   = 'vist_mnthly';
            return response()->json($res, 200);

    }

    public function annualVisits(){

        $totalVisits = ScheduledVisit::whereBetween('created_at', 
        [Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->count();
           $res['status']  = 'yrly';
            $res['message'] = 'Total Number of Visits Scheduled for this Year';
            $res['Visits'] = $totalVisits;
            $res['code']   = 'vist_yrly';
            return response()->json($res, 200);
    }
/* 
Get total number of Visits scheduled in a specific estate */

}
