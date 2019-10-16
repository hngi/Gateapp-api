<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Carbon\Carbon;
use App\User;

class LoginController extends Controller
{
     /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function expireTime() {
        $myTTL = 20160; //minutes
        return $this->jwt->factory()->setTTL($myTTL);
    }

    public function authenticate(Request $request)
    {     
        $this->expireTime();
        // Do a validation for the input
        $this->validateRequest($request);
        $credentials = User::where('phone', $request->input('phone'))
                             ->where('device_id', $request->input('device_id'))->first();

        if (!$token = Auth::guard()->login($credentials)) {
            return response()->json(['message_1' => 'invalid_credentials',
             'message_2' => 'Note: device type or phone number is not recognize, verify account and make this device your registered device'], 404);
        }

        $image_link = 'https://res.cloudinary.com/getfiledata/image/upload/';
        $image_format = 'w_200,c_thumb,ar_4:4,g_face/';
        
        $user = Auth::guard('api')->user();
        if ($user->email_verified_at != null) {
            $msg['success'] = true;
            $msg['message'] = 'Login Successful!';
            $msg['user'] = $user;
            $msg['image_link'] = $image_link;
            $msg['image_small_view_format'] = $image_format;
            $msg['token'] = 'Bearer '. $token;
            $msg['token_type'] = 'bearer';
            $msg['expires_in(minutes)'] = auth()->factory()->getTTL();
            return response()->json($msg, 200);
        } else {
            $msg['success'] = false;
            $msg['message'] = 'Login Unsuccessful: account has not been confirmed yet!';
            return response()->json($msg, 401);
        }
    }

    public function refresh()
    {   
        return response()->json([
            'access_token' => 'Bearer '. auth()->refresh(),
            'token_type'   => 'bearer',
            'expires_in(minutes)'   => (int)auth()->factory()->getTTL()
        ], 200);
    }

    public function validateRequest(Request $request){
            $rules = [
                'phone' => 'required',
                'device_id' => 'required',
            ];
            $messages = [
                'phone' => ':attribute is required',
                'device_id' => 'device_id is required',
            ];
        $this->validate($request, $rules, $messages);
    }
}
