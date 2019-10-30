<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estate;
use App\Home;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;

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
        if($estates) {
            $res['status']  = true;
            $res['message'] = 'All Estates (All)';
            $res['estates'] = $estates;
            return response()->json($res, 200);
        }else {
            $res['status']  = fasle;
            $res['message'] = 'No Record found';
            return response()->json($res, 404);
        }
    }

     // Display Estates by name
    public function name($name)
    {
         $country = ucfirst($name);
         $estates = Estate::where('estate_name', 'LIKE', "%{$name}%")->get();
         if (!$estates){
            //Error Handling
             $res['status']  = false;
             $res['message'] = 'No Estates found';
             return response()->json($res, 404);

         }else{
             $res['status']  = true;
             $res['message'] = 'Data Found (By Name)';
             $res['estates']  = $estates;
             return response()->json($res, 200);
        }
     }

     public function search($info)
     {
         $info = ucfirst($info);
         $estates = Estate::where('estate_name', 'LIKE', "%{$info}%")
                            ->orWhere('city','LIKE', "%{$info}%")
                            ->orWhere('country','LIKE', "%{$info}%")
                            ->get();
         if (!$estates){
            //Error Handling
             $res['status']  = false;
             $res['message'] = 'No Estates found';
             return response()->json($res, 404);

         }else{
             $res['status']  = true;
             $res['message'] = 'Data Found (By Name)';
             $res['estates']  = $estates;
             return response()->json($res, 200);
        }
     }
    // Display Estates by Id

     public function show($id)
     {

         $estate = Estate::where('id', $id)->first();
         if (!$estate){
            //Error Handling
             $res['status']  = false;
             $res['message'] = 'No Estate found';
             return response()->json($res, 404);

         }else{
             $res['status']  = true;
             $res['message'] = 'Data Found (By Name)';
             $res['estate']  = $estate;
             return response()->json($res, 200);
         }
     }

    // Display Estates by City

    public function showCity($city)
    {
        $city = ucfirst($city);
        $estates = Estate::where('city', 'LIKE', "%{$city}%")->get();
        if (!$estates){
           //Error Handling
             $res['status']  = false;
             $res['message'] = 'No Estates found';
             return response()->json($res, 404);

        }else{
             $res['status']  = true;
             $res['message'] = 'Data Found (By City)';
             $res['estate']  = $estates;
             return response()->json($res, 200);
        }
    }

    // Display Estates by Country

    public function showCountry($country)
    {
        $country = ucfirst($country);
        $estates = Estate::where('country', 'LIKE', "%{$country}%")->get();
        if (!$estates){
           // Error Handling
            $res['Error']    = "No Estates found";
            return response()->json($res, 404);
        }else
            $res['status']  = true;
            $res['message'] = 'Data Found (By Country)';
            $res['estate']  = $estates;
            return response()->json($res, 200);
    }



    public function store(Request $request, ImageController $image)
    {
        $this->validateRequest($request);
        //start temporay transaction
        DB::beginTransaction();
        $estate = new Estate;
        $estate_name = ucfirst($request->input('estate_name'));
        $city        = ucfirst($request->input('city'));
        $country     = ucfirst($request->input('country'));
        $address     = ucfirst($request->input('address'));

        try{

           $check = Estate::where('estate_name', $estate_name)
                             ->where('city', $city)
                             ->where('country', $country)
                             ->where('address', $address)
                             ->first();


           if(!$check) {
                $estate->estate_name   = $estate_name;
                $estate->city          = $city;
                $estate->country       = $country;
                $estate->address       = $address;

                if($request->hasFile('image')) {
                    $data = $this->upload($request, $image);
                    if($data['status_code'] !=  200) {
                        return response()->json($data, $data['status_code']);
                    }
                    $estate->image = $data['image'];
                }else {
                    $data = null;
                    $estate->image = 'noimage.jpg';
                }

                $estate->save();
                $msg['status']  = true;
                $msg['status_code'] = 201;
                $msg['message'] = 'Estate created succesfully!';
                $msg['image_info'] = $data;
                $msg['estate'] = $estate;
           }else {

                $msg['status']  = false;
                $msg['status_code'] = 402;
                $msg['message'] = 'This estate already exist, try joining instead!';
                $msg['estate'] = $estate;
           }

            DB::commit();

            return response()->json($msg, $msg['status_code']);
        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $msg['status']  = false;
            $msg['message'] = "Error: Estate not created, please try again!";
            $msg['user'] = null;
            $msg['hint'] = $e->getMessage();
            $msg['status_code'] = 501;
            return response()->json($msg, $msg['status_code']);
        }

    }

        public function update(Request $request, Estate $estate, $id, ImageController $image) {
              $this->validateRequest($request);
             //start temporay transaction
             DB::beginTransaction();

            try{
               $estate = Estate::where('id', $id)->first();
               if($estate) {
                    $estate->estate_name  = ucfirst($request->input('estate_name'));
                    $estate->city         = ucfirst($request->input('city'));
                    $estate->country      = ucfirst($request->input('country'));
                    $estate->address      = ucfirst($request->input('address'));

                    //Upload image
                    if($request->hasFile('image')) {
                        $data = $this->upload($request, $image, $estate);
                        if($data['status_code'] !=  200) {
                            return response()->json($data, $data['status_code']);
                        }
                        $estate->image = $data['image'];
                    }else {
                        $data = null;
                        $estate->image = 'noimage.jpg';
                    }

                    $estate->save();

                    $msg['status_code'] = 201;
                    $msg['message'] = 'Estate updated succesfully!';
                    $msg['estate'] = $estate;
                    $msg['image_info']   = $data;
               }else {
                    $msg['status_code'] = 404;
                    $msg['message'] = 'Estated not found!';
               }

                DB::commit();
                 return response()->json($msg, $msg['status_code']);

            }catch(\Exception $e) {
                //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
                DB::rollBack();

                $msg['status'] = false;
                $msg['message'] = "Error: Estate not updated, please try again!";
                $msg['hint'] = $e->getMessage();
                return response()->json($msg, 501);
            }
    }


    // Delete Estates by id

    public function deleteEstate($id) {

        $estates = Estate::where('id', $id)->first();
        $estates->delete();

        // Success message
        $res['message']    = "Estate deleted";
        return response()->json($res, 200);
    }


   public function validateRequest(Request $request){
        $rules = [
            'estate_name' => 'required|string',
            'city'        => 'required|string',
            'country'     => 'required|string',
            'address'     => 'required|string|unique:estates',
        ];

        $messages = [
            'unique' => 'The :attribute field already exist please select estate instead!.',
        ];
        $this->validate($request, $rules, $messages);
    }

    public function estateMemeber(Request $request, Home $home, $id) {
        $user = Auth::user();
        $check_if = Home::where('user_id', $user->id)->exists();
        $this->validate($request, [
            'house_block' => 'min:2',
        ]);

        DB::beginTransaction();
        try{
            if(!$check_if) {
                $msg['message'] = 'Your estate has beed selected succesfully!';
                $home->user_id   = $user->id;
                $home->estate_id = $id;
                $home->save();
            }else {
                $home = Home::where('user_id', $user->id)
                              ->with('estate')->with('user')->first();

                $msg['message'] = 'Your estate has been updated succesfully!';
                $home->user_id   = $user->id;
                $home->estate_id = $id;
                $home->house_block = ucfirst($request->input('house_block') ?? null);
                $home->save();
            }
            $estate = Estate::where('id', $id)->first();

            DB::commit();

            $msg['status'] = true;
            $msg['user_details'] =  $home;
            return response()->json($msg, 200);

        }catch(\Exeception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $msg['status'] = false;
            $msg['message'] = "Error: Estate Selection failed, please try again!";
            $msg['hint'] = $e->getMessage();
            return response()->json($msg, 501);

        }

    }
    public function upload($request, $image, $table=null) {
        $user = Auth::user();

        $this->validate($request, [
         'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $table);
        return $res;
    }

}
