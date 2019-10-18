<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estate;
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
   
     // Display Estates by name 

     public function search($name)
     {
         
         $estates = Estate::where('estate_name', 'LIKE', "%{$name}%")->get();
         if ($estates ->isEmpty()){
            //Error Handling
             $res['Error']    = "No Estates found";
             return response()->json($res, 404);  
             
         }else
             $allestates = EstateResource::collection($estates); //Use Resource to format Output 
             return response()->json($allestates);  
     }
    // Display Estates by Id 

     public function show($id)
     {
         
         $estates = Estate::where('estate_id', $id)->get();
         if ($estates ->isEmpty()){
            //Error Handling
             $res['Error']    = "No Estates found";
             return response()->json($res, 404);  
             
         }else
             $allestates = EstateResource::collection($estates); //Use Resource to format Output 
             return response()->json($allestates);  
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
    


    public function store(Request $request)
        {
            $data= Estate::firstOrCreate(
                ['estate_name' => $request-> input('estate_name'),
                'city' => $request-> input('city'),'country' => $request-> input('country')]);
            //$data =$request->all();
                if($data->save()){
                return response()->json($data);
            }else{
                $res['Error']    = "Something went wrong please try again";
                return response()->json($res, 400);

            }


        }

        public function update(Estate $estate) {
            $data =request()->all([]);

            $data =request()->all(["estate_name"=>"required", "city"=>"required", "country"=>"required"]);
            //start temporay transaction
            DB::beginTransaction();
            try{
                $estate->estate_name   =  $data['estate_name'];
                $estate->city   =  $data['city'];
                $estate->country   =  $data['country'];
                $estate->save();
                //if operation was successful save commit save to database
                DB::commit();
                $res['status']  = true;
                $res['data']    = $estate;
                $res['message'] = 'Your Estate Was Successfully Updated';
                return response()->json($res, 200);
            }catch(\Exception $e) {
                //rollback what is saved
                DB::rollBack();
                $res['status'] = false;
                $res['message'] = 'An Error Occured While Trying To Update Your Estate Information';
                $res['hint'] = $e->getMessage();
                return response()->json($res, 501);
            }
    }
    

    // Delete Estates by id 
        
    public function deleteEstate($id)
    {   
        $estates = Estate::where('estate_id', $id);
        $estates->delete();
        
        // Success message
        $res['message']    = "Estate deleted";
        return response()->json($res, 200);  
    }

}