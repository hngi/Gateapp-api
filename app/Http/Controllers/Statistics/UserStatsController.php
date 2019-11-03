<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Visitor_History;
use App\ScheduledVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserStatsController extends Controller
{

	//fetches scheduled visits for a resident

	 public function fetchScheduledVisit($resident_id){


     				$visitor = DB::table('scheduled_visits')->where('user_id', $resident_id)->get();
        			/*$ScheduledVisit = ScheduledVisit::where('user_id', $visitor_id )->value('visit_date');*/
					if(!$visitor){
						$res['status']  = false;
						$res['message'] = 'No Scheduled visits found for this resident';
			           /*$res['Resident Id'] = $resident_id;*/
			            return response()->json($res, 404); 
			        }else{
			           $res['status']  = true;
			            $res['message'] = 'Number of Scheduled Visits';
			          /* $res['Number of Scheduled Stats'] = $visitor;*/
			            $res['ScheduledVisits'] = $visitor->count();
			           return response()->json($res, 200);
			        }


    		}



//fetches finished visits for a resident

     public function finishedVisit($resident_id){


     				$visitor = DB::table('visitors_history')->where('user_id', $resident_id)->get();
        			/*$ScheduledVisit = ScheduledVisit::where('user_id', $visitor_id )->value('visit_date');*/
						if(!$visitor){
								$res['status']  = false;
								$res['message'] = 'No visits found for this resident';
								           /*$res['Resident Id'] = $resident_id;*/
								            return response()->json($res, 404); 
				        }else{
				           $res['status']  = true;
				            $res['message'] = 'Number of Finished Visits';
				        /*   $res['Number of Finished Visits'] = $visitor;*/
				             $res['FinishedVisits'] = $visitor->count();
				           return response()->json($res, 200);
				        }


    }


    //Total
}
