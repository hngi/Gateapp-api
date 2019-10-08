<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', 'Auth\LoginController@authenticate');

Route::post('/register/admin', 'Auth\RegisterController@admin');//has a role of 0
Route::post('/register/resident', 'Auth\RegisterController@resident');//has a role of 1
Route::post('/register/gateman', 'Auth\RegisterController@gateman');//has a role 2

Route::post('/verify', 'Auth\VerificationController@verify');

Route::post('/forgot/password', 'Auth\ForgotPasswordController@verify');
Route::post('/verify', 'Auth\VerificationController@verify');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
});