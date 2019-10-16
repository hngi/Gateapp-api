<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\Resident as ResidentResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResidentController extends Controller
{

    public function searchGatemanByPhone(Request $request)
    {
       if (Auth::check()) {
        $this->validatePhone($request);
        $gatemen = User::where('phone', 'LIKE', "%{$request->input('phone')}%")->where('role', "=", "2")->get();
        
        
        if ($gatemen ->isEmpty()){
            //Error Handling
            $res['Error']    = "No Gateman found with this phone number";
            return response()->json($res, 404);  
             
        } else
             $allgatemen = ResidentResource::collection($gatemen); //Use Resource to format Output 
             return response()->json($allgatemen); 
      } 
    }

    public function searchGatemanByName(Request $request)
    {
       if (Auth::check()) {
        $this->validateName($request);
        $gatemen = User::where('name', 'LIKE', "%{$request->input('name')}%")
        ->where('role', "=", "2")->get();
        if ($gatemen ->isEmpty()){
            //Error Handling
            $res['Error']    = "No Gateman found with this name";
            return response()->json($res, 404);  
             
        } else
             $allgatemen = ResidentResource::collection($gatemen); //Use Resource to format Output 
             return response()->json($allgatemen); 
      } 
    }

    public function validatePhone(Request $request){
        $rules = [
            'phone' => 'required',
            'device_id' => 'required',
        ];
        $messages = [
            'phone' => ':attribute is required',
            'device_id' => 'device_id is required',
        ];
        $this->validate($request, $rules, $messages);
    }

    public function validateName(Request $request){
        $rules = [
            'name' => 'required',
            'device_id' => 'required',
        ];
        $messages = [
            'name' => ':attribute is required',
            'device_id' => 'device_id is required',
        ];
        $this->validate($request, $rules, $messages);
    }
}
?>