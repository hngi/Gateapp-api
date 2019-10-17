<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Cloudder;


class ImageController extends Controller
{
   public function imageUpload(Request $request) {
       $this->validate($request, [
         'image' => "image|max:4000|required",
       ]);
       
       $user = Auth::user();
       if($request->hasFile('image') && $request->file('image')->isValid()) {
           //Check old image  and delete it if true
           if($user->image != 'no_image.jpg') {
               $oldImage = pathinfo($user->image, PATHINFO_FILENAME);
               try {
                   $del_img = Cloudder::destroyImage($oldImage);
               }catch(\Exception $e) {
                   $res['error'] = 'An error occured: please try agaim!';
                   return response()->json($res, 501);
               }
           }
           $file_name = $request->file('image')->getClientOriginalName();
           $image     = $request->file('image')->getRealPath();
           $cloudder  = Cloudder::upload($image);
            //Request the image info from api and save to db
            $uploadResult = $cloudder->getResult();
            //Get the public id or the image name
            $file_url = $uploadResult["public_id"];
            //Get the image format from the api
            $format = $uploadResult["format"];

            $user_image = $file_url.".".$format;

            //Return the image data from the database after upload
            return $this->saveImages($request, $user_image);

            // return response()->json($res,  $res['status']);
       }
   }

    public function saveImages(Request $request, $user_image)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try{
            $user->image = $user_image;
            $user->save();

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
            $res['image']  = $user_image;
            $res['status_code'] = 200;
            return $res;

        }catch(/Exception $e) {

          //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
          DB::rollBack();
          $res['status']   = false;
          $res['message']  = 'An error occured, please try again';
          $res['hint']     = $e->getMessage();
          $res['status_code'] =  501;
          return $res
        }
    }

} 