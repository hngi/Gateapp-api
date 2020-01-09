<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\Service;
use App\Category;
use App\Home;
use App\User;
use Illuminate\Http\Request;
use App\Service_Provider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ImageController;


class ServiceProviderController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'min:3,'],
        'phone' => 'required',
        'description' => ['required', 'min:20', 'max:255'],
        'estate_id' => ['required', 'exists:estates,id'],
        'category_id' => ['required', 'exists:sp_category,id'],
        'address' => ['required', 'string'],
        'contact_person' => ['required', 'string', 'min:4', 'max:100']
    ];


    public function showAll()
    {
        $user = Auth::user();

        // guards are not expected here
        if ($user->user_type == 'gateman') {
            return response(['message' => 'Forbidden'], 403);
        }

        $query = Service_Provider::allServices($user);

            $service = $query->get();

            if (!$service->isEmpty()) {
                $res["status"] = 200;
                $res["message"] = "All service providers.";
                $res["count"] = $service->count();
                $res["data"] = $service;
            } else {
                $res["status"] = 200;
                $res["message"] = "No service providers registered";
            }

        return response()->json($res, $res['status']);
    }

    public function groupByEstate() {
        $res = array();
        $uniqueEstate = array();


           $user = Auth::user();
           $user_type = $user->user_type;

           if ($user_type == 'gateman') {
               abort(403, 'Forbidden');
           }


            $query = Service_Provider::allServices($user);

            $service = $query->get();
            foreach($service as $key => $serv) {
                $uniqueEstate[$serv->estate][] = $serv;
            }

            if (!$service->isEmpty()) {
                $res["status"] = 200;
                $res["message"] = "All service providers grouped by estate";
                $res["count"] = $service->count();
                $res["data"] = $uniqueEstate;

            } else {
                $res["status"] = 200;
                $res["message"] = "No service providers registered";
            }

        return response()->json($res, $res['status']);
    }


    public function byEstate()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $estate_id = Home::where('user_id', $user_id)->pluck('estate_id');
        $res = array();

        try {

            $service = Category::with(['service_provider' => function ($query) use ($estate_id) {
                $query->whereIn('estate_id', $estate_id);
            }])->get();


            if (!$service->isEmpty()) {
                $res['status'] = 200;
                $res['message'] = "Retrieved Service Providers per category";
                $res['data'] = $service;
            } else {
                $res['status'] = 404;
                $res['message'] = "No categories found";
            }
        } catch (Exception $e) {
            $res['status'] = 501;
            $res['message'] = "An error occurred retrieving categories";
        }

        return response()->json($res, $res['status']);
    }


    public function show($id)
    {
        $res = array();
        $user = auth()->user();

        // guards are not expected
        if ($user->user_type == 'gateman') {
            return response([
                'message' => 'Forbidden',
            ], 403);
        }

        $role = $user->role;

        $query = Service_Provider::singleServiceProvider($user, $id);

        $service = $query->first();

        if (!is_null($service)) {
            $res["status"] = 200;
            $res["message"] = "Service provider found.";
            $res["data"] = $service;
        } else {
            $res["status"] = 404;
            $res["message"] = "Service Provider ({$id}) does not  exists";
        }



        return response()->json($res, $res['status']);
    }


    public function byCategory($category_id)
    {
        $res = array();

        $user  = auth()->user();

        if ($user->user_type == 'gateman') {
            abort(403, 'Forbidden');
        }

        $services = Service_Provider::allServices($user);

        $services = $services->where('category_id', $category_id)->get();

        if ($services->isEmpty()) {
            $res['status'] = 404;
            $res['message'] = "No service providers in this category";
        } else {
            $res['status'] = 200;
            $res['message'] = "Retrieved service providers";
            $res['data'] = $services;
        }

        return response($res, $res['status']);

    }

    public function create(Request $request, ImageController $image)
    {
        $inputs = $request->validate($this->rules);

        $user = auth()->user();
        $user_type = $user->user_type;
   
        // check if  the user (if estate admin) is an admin of the estate
        // selected

        if (
            $user_type != 'super_admin'
            && (! $this->belongsToEstate($inputs['estate_id'], $user->id))
         ) {
            return response([
                'message' => " You are unable to add service providers to the selected estate at this time.",
            ], 403);
        }


        //start temporay transaction
        DB::beginTransaction();
        try {

            $service = new Service_Provider($inputs);

            // if a superadmin admin is adding the service, make it activated
            $service->status = $user_type == 'super_admin';
            //Upload image
            //Upload image
            if ($request->hasFile('image')) {
                $data = $this->upload($request, $image);
                if ($data['status_code'] != 200) {
                    return response()->json($data, $data['status_code']);
                }
                $service->image = $data['image'];
            } else {
                $data = null;
                $service->image = 'gateguard-logo.png';
            };

            $service->save();

            //if operation was successful save commit save to database
            DB::commit();
            $res["status"] = true;
            $res["message"] = "Service Provider created";
            $res["data"] = $service;
            $res['image_info'] = $data;
            return response()->json($res, 200);

        } catch (\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An error occured, please try again!';
            $res['hint'] = $e->getMessage();
            return response()->json($res, 501);

        }

    }

    public function update(Request $request, $id, ImageController $image)
    {

        $service = Service_Provider::findOrFail($id);

        $user = auth()->user();


        // if user is an estate admin, check if the SP is in their estate
        // if no, they should not be able to edit the SP
        $can_edit = $this->estateAdminCanEditSP($user, $service);

        if (!$can_edit) {
            return response(['message' => 'Forbidden'], 403);
        }

        $rules = $this->rules;
        // Estate ID should not be editable, so we ignore it
        unset($rules['estate_id']);

        $inputs  = $request->validate($rules);
        $service->fill($inputs);
        
        

        //start temporay transaction
        DB::beginTransaction();
        try {
            //Upload image
            if ($request->hasFile('image')) {
                $data = $this->upload($request, $image, $service);
                if ($data['status_code'] != 200) {
                    return response()->json($data, $data['status_code']);
                }
                $service->image = $data['image'];
            }

            $service->update();

            //if operation was successful save commit save to database
            DB::commit();
            $res["status"] = true;
            $res["message"] = "Service provider Updated Successfully!";
            $res["service"] = $service;
            $res['image_info'] = $data;
            return response()->json($res, 200);
        } catch (\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An error occured, please try again!';
            $res['hint'] = $e->getMessage();
            return response()->json($res, 501);

        }
    }

    private function estateAdminCanEditSp(User $user, Service_Provider $service)
    {
        if ($user->user_type == 'super_admin') {
            return true;
        }

        return $this->belongsToEstate($service->estate_id, $user->id);

    }

    private function belongsToEstate(int $estate_id, int $user_id) 
    {
        return  Home::query()->where('user_id', $user_id)->where('estate_id', $estate_id)->exists();
    }


    public function destroy($id)
    {
     $service = Service_Provider::destroy($id);
     if($service)
     {
      // Am sure the service provider is still in db so lets actually delete the person
      $trash = Service_Provider::onlyTrashed()->find($id);
      if(!is_null($trash))
      {
       $trash->forceDelete();
       $res['status'] = 200;
       $res["message"] = "Service Provider Deleted!";

       return response()->json($res, $res['status']);
      }
     }
      else
     {
      $res['status'] = 404;
      $res["message"] = "Unable To Delete Service Provider!";

      return response()->json($res, $res['status']);
     }
    }

    public function softDeleted()
    {
     $service = Service_Provider::onlyTrashed()->get();

     if($service)
     {
      $res['status'] = 200;
      $res["message"] = "Suspended service providers!";
      $res["count"] = $service->count();
      $res["data"] = $service;

      return response()->json($res, $res["status"]);
     }
      else
     {
      $res['status'] = 501;
      $res["message"] = "Error Getting Suspended Service Providers!";

      return response()->json($res, $res["status"]);
     }
    }

    public function softDelete($id)
    {
     $service = Service_Provider::destroy($id);
     if($service)
     {
      $res["status"] = 200;
      $res["message"] = "Service Provider Suspended!";
      $res["data"] = $service;

      return response()->json($res, $res["status"]);
     }
      else
     {
      $res["status"] = 501;
      $res["message"] = "Unable To Suspend Service Provider!";

      return response()->json($res, $res["status"]);
     }
    }

    public function search($id)
    {
     try {
          $db = Service_Provider::find($id);
          $name = $db->name ?? 'null';
          $phone = $db->phone ?? 'null';
          $cat_id = $db->category_id ?? 'null';
          $des = $db->description ?? 'null';
          $status = $db->status;
          $created = $db->created_at ?? 'null';
          $updated = $db->updated_at ?? 'null';

          if($status == 1)
          {
           $res["status"] = "Active";
          }
           else
          {
           $res["status"] = "Inactive";
          }

         $cat = Category::find($cat_id);
         $cat_name = $cat->title;

         $res["status_code"] = 200;
         $res["message"] = "Success!";
         $res["name"] = $name;
         $res["phone"] = $phone;
         $res["description"] = $des;
         $res["created"] = $created;
         $res["updated"] = $updated;
         $res["category"] = $cat_name;

         return response()->json($res, $res["status_code"]);
        }
         catch (\Exception $e)
        {
         $res["status_code"] = 501;
         $res["message"] = "Failed!";
         $res["error"] = $e->getMessage();

         return response()->json($res, $res["status_code"]);
        }
       }

    // Method to get all service provider requests
    public function serviceProviderRequests()
    {
     try {
          $requests = [];
          $services = Service_Provider::with('estate')->with('category')->get();

          foreach($services as $service)
          {
           $status = $service->status;
           if($status == 0)
           {
            array_push($requests, $services);
           }
          }

          $res["status_code"] = 200;
          $res["message"] = "Success!";
          $res["requests"] = $requests;

          return response()->json($res, $res["status_code"]);
         }
          catch (\Exception $e)
         {
          $res["status_code"] = 501;
          $res["message"] = "Failed!";
          $res["error"] = $e->getMessage();

          return response()->json($res, $res["status_code"]);
         }
    }

    public function restore($id)
    {
     $service = Service_Provider::onlyTrashed()->find($id)->restore();
     if($service)
     {
      $res["status"] = 200;
      $res["message"] = "Service Provider Was Unsuspended!";
      $res["data"] = $service;

      return response()->json($res, $res["status"]);
    }
     else
    {
     $res["status"] = 501;
     $res["message"] = "Unable To Unsuspend Service Provider!";

     return response()->json($res, $res["status"]);
    }
   }

    public function upload($request, $image, $table = null)
    {
        $user = Auth::user();

        $this->validate($request, [
            'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $table);
        return $res;
    }
    public function create_request(Request $request, ImageController $image)
    {
        $inputs = $request->validate($this->rules);

        //start temporay transaction
        DB::beginTransaction();
        try {

            $service = new Service_Provider($inputs);


            //Upload image
            //Upload image
            if ($request->hasFile('image')) {
                $data = $this->upload($request, $image);
                if ($data['status_code'] != 200) {
                    return response()->json($data, $data['status_code']);
                }
                $service->image = $data['image'];
            } else {
                $data = null;
                $service->image = 'noimage.jpg';
            };

            $service->save();

            //if operation was successful save commit save to database
            DB::commit();
            $res["status"] = true;
            $res["message"] = "Service Provider Request Created Successfully!";
            $res["data"] = $service;
            $res['image_info'] = $data;
            return response()->json($res, 200);

        } catch (\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An error occured, please try again!';
            $res['hint'] = $e->getMessage();
            return response()->json($res, 501);

        }

    }
    public function approve($id)
    {
        $application = Service_Provider::find($id);

        if($application){
            $application->status = 1;
            $application->save();
            return response()->json(['status' => true, 'message' => 'Service provider accepted'], 200);
        }else{
            return response()->json(['status' => false, 'message' => 'No records found'], 404);
        }




    }
    public function reject($id)
    {
        $application = Service_Provider::find($id);
        if(!$application){
            return response()->json(['status' => false, 'message' => 'No records found'], 404);

        }else{


            $application->delete($id);
            return response()->json(['status' => true, 'message' => 'Service provider rejected'], 200);
        }

    }
}
