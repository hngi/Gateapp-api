<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\User;
use App\Visitor_History;
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

    /**
     * Get statistics for estate
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function generalStats($id)
    {
        try {

            if (! Estate::query()->where('id', $id)->exists()) {
                return response()->json(['message' => "Estate {$id} does not exists."], 404);
            }


            $residents =  User::query()->join('homes', 'homes.user_id', 'users.id')
                ->where('users.user_type', 'resident')
                ->where('homes.estate_id', $id)
                ->count();

            $gatemen =  User::query()->join('homes', 'homes.user_id', 'users.id')
                ->where('users.user_type', 'gateman')
                ->where('homes.estate_id', $id)
                ->count();

            $visits = Visitor_History::query()->whereIn('user_id', function ($query) use ($id) {
                return $query->select('user_id')->distinct()->from('homes')
                    ->where('homes.estate_id', $id);
            })->count();

            $visits_past_week = Visitor_History::query()->whereIn('user_id', function ($query) use ($id) {
                return $query->select('user_id')->distinct()->from('homes')
                    ->where('homes.estate_id', $id);
            })
                ->whereBetween('created_at', [
                    now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()
                ])->count();

            return response()->json(['data' => [
                'residents' => $residents, 'gatemen' => $gatemen,
                'visits' => $visits, 'visits_past_week' => $visits_past_week
            ]]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
