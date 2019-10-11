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

    public function authenticate(Request $request)
    {
        // Do a validation for the input
        $this->validateRequest($request);

        $myTTL = 60*24; //minutes
        $this->jwt->factory()->setTTL($myTTL);
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = $this->jwt->attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        $user = Auth::guard('api')->user();
        $image_link = 'https://res.cloudinary.com/getfiledata/image/upload/';
        $image_format = 'w_200,c_thumb,ar_4:4,g_face/';

        if ($user->email_verified_at != null) {
            $msg['success'] = true;
            $msg['message'] = 'Login Successful!';
            $msg['user'] = $user;
            $msg['image_link'] = $image_link;
            $msg['image_small_view_format'] = $image_format;
            $msg['token'] = 'Bearer '. $token;
            return response()->json($msg, 200);
        } else {
            $msg['success'] = false;
            $msg['message'] = 'Login Unsuccessful: account has not been confirmed yet!';
            return response()->json($msg, 401);
        }
    }

    public function validateRequest(Request $request){
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ];
            $messages = [
                'required' => ':attribute is required',
                'email' => ':attribute not a valid format',
            ];
        $this->validate($request, $rules, $messages);
    }
}
