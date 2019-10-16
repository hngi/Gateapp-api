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
           $result    = $cloudder->getResult();
           $res['result'] = $result;
           return response()->json($result, 200);
       }
   }
} 