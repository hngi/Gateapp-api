<?php

namespace App\Http\Controllers;
use App\Estate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Resources\Estate as EstateResource;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estates = Estate::all();
        $allestates = EstateResource::collection($estates); //Use Resource to format Output 
        $res['message'] = 'All Estates';
        $res['Estates'] = $allestates;
        return response()->json($res, 200);
    }
   

    // Display Estates by City 

    public function showCity($city)
    {
        
        $estates = Estate::where('city', $city)->get();
        if ($estates ->isEmpty()){
           //Error Handling
            $res['Error']    = "No Estates found";
            return response()->json($res, 404);  
            
        }else
            $allestates = EstateResource::collection($estates); //Use Resource to format Output 
            return response()->json($allestates);  
    }
    
    // Display Estates by Country 

    public function showCountry($country)
    {   
        $estates = Estate::where('country', $country)->get();
        if ($estates ->isEmpty()){
           // Error Handling
            $res['Error']    = "No Estates found";
            return response()->json($res, 404);  
        }else
            
            $allestates = EstateResource::collection($estates); //Use Resource to format Output 
            return response()->json($allestates);  
    }
    
    public function deleteEstate($id)
    {   
        $estates = Estate::where('estate_id', $id)->get();
        $resident->delete();
        // Success message
        $res['Message']    = "Estate deleted";
        return response()->json($res, 200);  
    }
}
