<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WebEstate;
use Illuminate\Support\Facades\DB;

class WebEstateController extends Controller
{
 public function addEstate(Request $request)
 {
  $this->validateRequest($request);
  //start temporay transaction
  DB::beginTransaction();
  $estate_name = ucfirst($request->input('estate_name'));
  $city = ucfirst($request->input('city'));
  $country = ucfirst($request->input('country'));
  $address = ucfirst($request->input('address'));
  
  // TRY
  try{
      $check = Estate::where('estate_name', $estate_name)
                    ->where('city', $city)
                    ->where('country', $country)
                    ->where('address', $address) 
                    ->first();
                    
     // Check if estate already exists
     if(!$check)
     {
      $estate = Estate::create([
            'estate_name' => $estate_name,
            'city' => $city,
            'country' => $country,
            'address' => $address,
         ]);
         
      // Estate name
      $est-name = $estate['estate_name'];
      
      // Status
      $status = 'success';
      
      // Message
      $msg = $est-name.' Was Created Succesfully!';
     }
      else
     {         
      // Message
      $msg = 'Estate Already Exists!';
      
      // Status
      $status = 'error';
     }
     
     // Commit changes
     DB::commit();
     
     // Return
     return back()->with($status, $msg);
    } catch(\Exception $e)
    {
     // Remove what was saved
     DB::rollBack();
     
     // Message
     $msg = 'An Unexpected Error Occured!';
      
     // Status
     $status = 'error';
      
     // Return
     return back()->with($status, $msg);
    }
  }

 // Estate
 public function estate()
 {
  return view('add_estate');
 }
}
