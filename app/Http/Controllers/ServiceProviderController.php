<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(), [
           
           'name' => 'required',
           'phone' => 'required',
           'description' => 'required',
           'image' => 'required',
           'estate_id' => 'required|int'
       ]);

         if ($validator->fails()) {
            return [
                  
                  'message' => 'Please Fill all Fields'      ]; 
       }
        
        return Service_Provider::create($request->all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service_Provider::find($id);

        if($service){
            $res["Message"] = "Unique Service Provider";
            $res["data"] = $service;
            return response()->json($res, 200);
        }else{
            $res["Error"] = "Invalid ID Number";
            return response()->json($res, '404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service_Provider::destroy($id);

        if($service){
            $res["Success"] = $service." Service Provider Deleted!";
            return response()->json($res, 200);
        }else{
            $res["Error"] = "Invalid ID Number";
            return response()->json($res, '404');
        }
    }

}
