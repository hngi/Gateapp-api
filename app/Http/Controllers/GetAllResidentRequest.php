<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GatemanGetAllResidentInvitation;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class GetAllResidentRequest extends Controller
{
    public function GetAllRequestToGateman(){

    	$user = Auth::user();

    	$residents = GatemanGetAllResidentInvitation::where('request_status', 1);

    	if (!$residents) {

			$res['message'] = "Invitations not found";
		   	$res['payment'] = null;
		   	$res['status'] = 404;
		   	return response()->json($res, $res['status']);
		}else{
			$stach_details = [];
			foreach ($residents as $resident) {
				if ((!empty($resident->user_id)) && $user->id == $resident->gateman_id)) {
					$User = User::where('id', $resident->user_id);
					if ($User) {
						// user Exist,then push detials
						array_push($stach_details, $User);
					}
				}
			}
			//  returning resident users that invited current gateman user
			$res['message'] = "Invitations from residents was found";
		   	$res['resident_details'] = $stach_details;
		   	$res['status'] = 200;

		   	return response()->json($res, $res['status']);
		}
    }
}
