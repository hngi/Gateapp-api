<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Carbon\Carbon;
use App\User;

class AdminLoginController extends Controller
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
        $myTTL = 3600; //minutes
        return $this->jwt->factory()->setTTL($myTTL);
    }

    public function authenticate(Request $request)
    {     
        $this->expireTime();
        // Do a validation for the input
        $this->validateRequest($request);
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = $this->jwt->attempt($credentials)) {
                return response()->json(['message' => 'Invalid Credential'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
        $image_link = 'https://res.cloudinary.com/getfiledata/image/upload/';
        $image_format = 'w_200,c_thumb,ar_4:4,g_face/';
        
        $user = Auth::guard('api')->user();
        $msg['success'] = true;
        $msg['message'] = 'Admin Login Successful!';
        $msg['user'] = $user;
        $msg['user_type'] = $user->user_type;
        $msg['image_link'] = $image_link;
        $msg['image_small_view_format'] = $image_format;
        $msg['token'] = 'Bearer '. $token;
        $msg['token_type'] = 'bearer';
        $msg['expires_in(minutes)'] = auth()->factory()->getTTL();
        return response()->json($msg, 200);
    }
    public function validateRequest(Request $request){
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ];
        $messages = [
            'email' => ':attribute not a valid format',
        ];
    $this->validate($request, $rules, $messages);
}
}
