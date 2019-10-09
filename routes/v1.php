<?php


//Please indentify your trademark the way i have done around your api

//*********************************Authentication Routes *******************************************************

//JuniCodefire *******************************************************
//registration
Route::post('register/admin', 'Auth\RegisterController@admin');//has a role of 0

Route::post('register/resident', 'Auth\RegisterController@resident');//has a role of 1

Route::post('register/gateman', 'Auth\RegisterController@gateman');//has a role 2

//Login
Route::post('login', 'Auth\LoginController@authenticate');

//Verify account
Route::post('verify', 'Auth\VerificationController@verify');

//forgot Password
Route::post('password/verify', 'Auth\ForgotPasswordController@verifyPassword');

//Reset password for a new password
Route::put('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('test', 'TestController@test');

//End JuniCodefire *******************************************************
//-----------------------------------End Authentication Routes ----------------------------------------------------

//Example how your route should be , please code along enjoy coding

//Admin Routes (Specific Route)*******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

	//Show all user(this route is for only admin)(admin)
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');

	//Show all user for a particular role(this route is for only admin)(admin)
    Route::get('user/all/{role_id}', 'UserProfileController@role')->middleware('admin');
});

//Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

    //Show one user
    Route::get('user', 'UserProfileController@index');

    //Edit user account
    Route::put('user/edit', 'UserProfileController@update');

    //Delete user account
    Route::get('user/delete', 'UserProfileController@destroy');
});

// Kazeem Asifat QRCode generator *******************************************
Route::get('generate-code', 'QrCodeGenerator@generateCode');


//Visitor Routes *******************

	//This is the route group every authenticated route with jwt token should go in here
    //Edit Visitor account
    Route::put('visitor/{id}', 'VisitorController@update');
    //Delete Visitor account
    Route::delete('visitor/{id}', 'VisitorController@destroy');
