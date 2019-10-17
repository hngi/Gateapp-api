<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_Provider;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceProviderController extends Controller
{
    public function showAll() {
        $res = array();
        
        if (Auth::check()) {
           $user = Auth::user();
           $role = $user->role_id;
            
           if ($role === 1 || role === 2) {
            $service = Service_Provider::all();
            $res["status"] = 200;
            $res["message"] = "All service provider";
            $res["data"] = $service;
               
           } else {
               $res['status'] = 401;
               $res['message'] = "You must login as a resident";
           }
       } else {
        $res['status'] = 401;
        $res['message'] = "You are not logged in";
       }
        return response()->json($res, $res['status']);
    }

    public function show($id)
    {
        $res = array();
        
        if (Auth::check()) {
           $user = Auth::user();
           $role = $user->role_id;
            
           if ($role === 1 || role === 2) {
            $service = Service_Provider::find($id);
            $res["status"] = 200;
            $res["message"] = "One service provider";
            $res["data"] = $service;
               
           } else {
               $res['status'] = 401;
               $res['message'] = "You must login as a resident";
           }
       } else {
        $res['status'] = 401;
        $res['message'] = "You are not logged in";
       }
        return response()->json($res, $res['status']);
    }

    public function byCategory($category_id) {
        $res = array();
        
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role_id;
            if ($role === 1 || role === 2) {
            $services = Service_Provider::where('category_id', $category_id);
            
            
            if(!$services->isEmpty()) {
                $res['status'] = 200;
                $res['message'] = "Retrieved service providers";
                $res['data'] = $services;
                
            } else {    
                $res['status'] = 401;
                $res['message'] = "You are not logged in";
            }
        } catch(Exception $e) {
            $res['status'] = 501;
            $res['message'] = "An error occurred trying to retrieve service providers";
        }

        return response()->json($res, $res['status']);
    }

    public function create(Request $request)
    {
         $validator = Validator::make($request->all(), [
               'name' => 'required|string|min:3',
               'phone' => 'required',
               'description' => 'required',
               'image' => 'required',
               'estate_id' => 'required|int'
               'category_id' => 'required|int'
          ]);

        if ($validator->fails()) {
        return ['message' => 'Please fill all Fields']; 
        }
        //start temporay transaction
        DB::beginTransaction();
        try{

            $service = Service_Provider::create($request->all());

            //if operation was successful save commit save to database
            DB::commit();
            $res["status"] = true;
            $res["message"] = "Service Provider created";
            $res["data"] = $service;
            return response()->json($res, 200);

        }catch(\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An error occured, please try again!';
            $res['hint'] = $e->getMessage();
            return response()->json($res, 501);

        }

    }

     public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
           'name'        => 'required|string|min:3',
           'phone'       => 'required',
           'description' => 'required',
           'image'       => 'required',
           'estate_id'   => 'required|int',
           'category_id' => 'required|int'
      ]);

        if ($validator->fails()) {
        return ['message' => 'Please fill all Fields']; 
        }
        //start temporay transaction
        DB::beginTransaction();
        try{    
            $service              = Service_Provider::find($id);
            $service->name        = $request->input("name");
            $service->phone       = $request->input("phone");
            $service->description = $request->input("description");
            $service->image       = $request->input("image");
            $service->estate_id   = $request->input("estate_id");
            $service->category_id = $request->input("category_id");
            $service->save();

             //if operation was successful save commit save to database
            DB::commit();
            $res["status"]  = true;
            $res["message"] = "Service provider Updated Successfully!";
            return response()->json($res, 200);
        }catch(\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An error occured, please try again!';
            $res['hint'] = $e->getMessage();
            return response()->json($res, 501);

        }
    }

    public function destroy($id)
    {
        $service = Service_Provider::destroy($id);

        if($service){
            $res['status'] = true;
            $res["message"] = $service." Service Provider Deleted!";
            return response()->json($res, 200);
        }else{
            $res['status'] = false;
            $res["message"] = "An error occured, please try again";
            return response()->json($res, 501);
        }
    }

}
