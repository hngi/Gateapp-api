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

//Please indentify your trademark the way i have done around your api

//*********************************Authentication Routes *******************************************************

//JuniCodefire *******************************************************
//registration
Route::post('v1/register/admin', 'Auth\RegisterController@admin');//has a role of 0

Route::post('v1/register/resident', 'Auth\RegisterController@resident');//has a role of 1

Route::post('v1/register/gateman', 'Auth\RegisterController@gateman');//has a role 2

//Login
Route::post('v1/login', 'Auth\LoginController@authenticate');

//Verify account
Route::post('v1/verify', 'Auth\VerificationController@verify');

//forgot Password
Route::post('v1/password/verify', 'Auth\ForgotPasswordController@verifyPassword');

//Reset password for a new password
Route::put('v1/password/reset', 'Auth\ResetPasswordController@reset');


//End JuniCodefire *******************************************************

//-----------------------------------End Authentication Routes ----------------------------------------------------

//Example how your route should be , please code along enjoy coding

//Admin Routes (Specific Route)*******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

	//Show all user(this route is for only admin)(admin)
    Route::get('v1/user/all', 'UserProfileController@all')->middleware('admin');

	//Show all user for a particular role(this route is for only admin)(admin)
    Route::get('v1/user/all/{role_id}', 'UserProfileController@role')->middleware('admin');
});

//Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

    //Show one user
    Route::get('v1/user', 'UserProfileController@index');

    //Edit user account
    Route::put('v1/user/edit', 'UserProfileController@update');

    //Delete user account
    Route::get('v1/user/delete', 'UserProfileController@destroy');

    // Kazeem Asifat QRCode generator *******************************************
});

//This our testing api routes
Route::get('v1/test', 'TestController@test');
//The qr code has been mordify to be sent as jason
Route::get('v1/generate-code', 'TestController@qrCode');

