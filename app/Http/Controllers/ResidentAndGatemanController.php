<?php

namespace App\Http\Controllers;
use App\ResidentAndGateman;

use Illuminate\Http\Request;

class ResidentAndGatemanController extends Controller
{
    public function searchGateman($phone) {
        $gateman = User::all()
                        ->where('role', 2)
                        ->where('phone', $phone)
                        ->get();

        if($gatemans) {
            $res['status'] = true;
            $res['message'] = 'Gateman found';
            $res['gateman'] = $gateman;
            return response()->json($res, 200);
        }else {
            $res['status'] = false;
            $res['message'] = 'Gateman not found';
            return response()->json($res, 404);
        }
    }

    public function addGateman($id) {

        $resident_gateman = new ResidentAndGateman();
        $resident_gateman->gateman_id = $id;
        $resident_gateman->resident_id = Auth::user()->id;
        $resident_gateman->save();

        $res['status'] = true;
        $res['message'] = 'Gateman Added Successfully';
        return response()->json($res, 200);
    }

}
