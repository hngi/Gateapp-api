<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Service_Provider;
use Cloudder;


class ImageController extends Controller
{
  //Indicate the table before use
   public function imageUpload(Request $request, $table='users', $sp_id=null) {

       if ($table == 'users') {
            $onCurrent = Auth::user();
       }elseif($table == 'service_provider' && $sp_id != null) {
            $onCurrent = Service_Provider::where('id', $sp_id)->first();
       }

       if($request->hasFile('image') && $request->file('image')->isValid()) {
           //Check old image  and delete it if true
            $extension = strtolower($request->file('image')->extension());
            //Get the allow extentions
            $allowed_ext = array("png", "jpg", "jpeg");
            //Get the Image Size
            $file_size = filesize($request->file('user_image'));

              if (in_array($extension, $allowed_ext)) {

                  //Error hadling to control file size
                  if ($file_size > 500000) {
                    $res['error'] = 'Too large(Only <= 500000kb';
                    $res['status_code'] = 400;
                    return $res;
                  }
                 if($onCurrent->image != 'no_image.jpg') {
                     $oldImage = pathinfo($onCurrent->image, PATHINFO_FILENAME);
                     try {
                         $del_img = Cloudder::destroyImage($oldImage);
                     }catch(\Exception $e) {
                         $res['error'] = 'An error occured: please try agaim!';
                         $res['status_code'] = 501;
                         return $res;
                     }
                 }

                 // $file_name = $file->getClientOriginalName();
                $image     = $request->file('image')->getRealPath();
                // dd($image);
                $cloudder  = Cloudder::upload($image);
                  //Request the image info from api and save to db
                $uploadResult = $cloudder->getResult();
                //Get the public id or the image name
                $file_url = $uploadResult["public_id"];
                //Get the image format from the api
                $format = $uploadResult["format"];

                $user_image = $file_url.".".$format;

                //Return the image data from the database after upload
                return $this->saveImages($request, $user_image, $onCurrent);
            }
       }
   }

    public function saveImages(Request $request, $user_image, $onCurrent)
    {

        DB::beginTransaction();
        try{
            $onCurrent->image = $user_image;
            $onCurrent->save();

            //if operation was successful save commit save to database
            DB::commit();

            $res['status']  = true;
            $res['message'] = "Upload Successful!";
            $res['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
            $res['image_prop'] = [
              'cropType1' => 'c_fit',
              'cropType2' => 'g_face',
              'imageStyle' => 'c_thumb',
              'heigth' => 'h_577',
              'width' =>  '433',
              'widthThumb' => 'w_200',
              'aspectRatio' => 'ar_4:4'
            ];
            $res['user_data'] =  $onCurrent;
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