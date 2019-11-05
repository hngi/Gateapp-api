<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Service_Provider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Home;

class ServiceStatsController extends Controller
{
    // Total number of service provider in the system 
    public function index(){
        $totalServices = Service_Provider::where('status','1')->count(); 
            $res['status']  = 'all';
            $res['message'] = 'Total Number of Service providers ';
            $res['sp_count'] = $totalServices;
            $res['code']   = 'serv_all';
            return response()->json($res, 200);
    }

    public function weeklyService(){
        $totalServices = Service_Provider::where('status','1')->whereBetween('created_at', 
        [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count(); 
            $res['status']  = 'wkly';
            $res['message'] = 'Total Number of Service providers added this week';
            $res['sp_count'] = $totalServices;
            $res['code']   = 'serv_wkly';
            return response()->json($res, 200);
    }

    public function monthlyService(){
        $totalServices = Service_Provider::where('status','1')->whereBetween('created_at', 
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count(); 
            $res['status']  = 'mnthly';
            $res['message'] = 'Total Number of Service providers added this month';
            $res['sp_count'] = $totalServices;
            $res['code']   = 'serv_mntly';
            return response()->json($res, 200);
    }


    // Total number of service provider in a particular estate  system 
    public function show(){

        $user = Auth::user();
        $user_id = $user->id;
        //Home::where('user_id', $user_id)->select('estate_id');
        $estate_id = DB::table('homes')->where('user_id', $user_id)->value('estate_id');
        $estateServiceProviders = Service_Provider::where([
            ['status', '1'],['estate_id', $estate_id]
            ])->count();
        if ($estateServiceProviders){
            $res['status']  = true;
            $res['message'] = 'Total Number of Service providers  ';
            $res['sp_count'] = $estateServiceProviders;
            $res['estate_id'] = $estate_id;
            return response()->json($res, 200);
        }

    }

    //Total number of Pending Service Provider requests on the system 
    public function pendingRequests(){
        $pendingServiceProviders = Service_Provider::where('status', '0')->count();
        if ($pendingServiceProviders){
            $res['status']  = true;
            $res['message'] = 'Total Number of Pending Service providers  ';
            $res['sp_count'] = $pendingServiceProviders;
            return response()->json($res, 200);
        }
    }

     //Total number of Pending Service Provider requests in an estate
     public function pendingEstateRequests(){
        $user = Auth::user();
        $user_id = $user->id;
        $estate_id = DB::table('homes')->where('user_id', $user_id)->value('estate_id');
        $pendingServiceProviders = Service_Provider::where([
            ['status', '0'],['estate_id',$estate_id]
            ])->count();
        if ($pendingServiceProviders){
            $res['status']  = true;
            $res['message'] = 'Total Number of Pending Service providers  ';
            $res['sp_count'] = $pendingServiceProviders;
            $res['estate_id'] = $estate_id;
            return response()->json($res, 200);
        }
    }
}
