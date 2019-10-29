<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Service_Provider;
use App\Visitor;
use Cloudder;


class ImageController extends Controller
{
  //Indicate the table before use
   public function imageUpload($request, $onCurrent=null) {

       if($request->hasFile('image') && $request->file('image')->isValid()) {
           //Check old image  and delete it if true
            $extension = strtolower($request->file('image')->extension());
            //Get the allow extentions
            $allowed_ext = array("png", "jpg", "jpeg");
            //Get the Image Size
            $file_size = filesize($request->file('user_image'));

              if (in_array($extension, $allowed_ext)) {
                  if ($file_size > 500000) {
                    $res['error'] = 'Too large(Only <= 500000kb';
                    $res['status_code'] = 400;
                    return $res;
                  }
                //Return the image data from the database after upload
                 return $this->saveImages($request, $onCurrent);
              }
       }else {
            $res['error'] = 'Image is invalid';
            $res['status_code'] = 400;
            return $res;
       }
   }

    public function saveImages(Request $request, $onCurrent)
    {

        DB::beginTransaction();
        try{
              //Error hadling to control file size
            if($onCurrent != null) {
                if($onCurrent->image != 'noimage.jpg') {
                 $oldImage = pathinfo($onCurrent->image, PATHINFO_FILENAME);
                    try {
                        $del_img = Cloudder::destroyImage($oldImage);
                    }catch(\Exception $e) {
                        $res['error'] = 'An error occured while deleting old image: please try again!';
                        $res['status_code'] = 501;
                        $res['hint'] = $e->getMessage(); 
                         return $res;
                     }
                 }
            }

            // $file_name = $file->getClientOriginalName();
            $image        = $request->file('image')->getRealPath();
            // dd($image);
            $cloudder     = Cloudder::upload($image);
            //Request the image info from api and save to db
            $uploadResult = $cloudder->getResult();
            //Get the public id or the image name
            $file_url     = $uploadResult["public_id"];
            //Get the image format from the api
            $format       = $uploadResult["format"];

            $user_image   = $file_url.".".$format;

            //if operation was successful save commit+ save to database
            DB::commit();

            $res['message'] = "Upload Successful!";
            $res['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
            $res['image_round_format']  = 'w_200,c_fill,ar_1:1,g_auto,r_max/';
            $res['image_square_format'] = 'w_200,ar_1:1,c_fill,g_auto/';
            $res['image_example_link']  = 'https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/'.$user_image;
            $res['image']  = $user_image;
            $res['status_code'] = 200;
            return $res;

        }catch(\Exception $e) {

          //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
          DB::rollBack();
          $res['status']   = false;
          $res['message']  = 'An error occured, please try again';
          $res['hint']     = $e->getMessage();
          $res['status_code'] =  501;
          return $res;
        }
    }

} 