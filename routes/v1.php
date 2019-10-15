<?php


//Authentication Routes ******************************************************
    //Registration
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



//Admin Routes (Specific Route)*******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

	//Show all user(this route is for only admin)(admin)
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');

	//Show all user for a particular role(this route is for only admin)(admin)
    Route::get('user/all/{role_id}', 'UserProfileController@role')->middleware('admin');

    //show one admin
    Route::get('admin/{id}', 'UserProfileController@showOneAdmin')->middleware('admin');

     //**********John's Api***************//
    //Edit Estate
    Route::patch('/estate', 'EstateController@update')->middleware('admin');

    //Delete Estates by estate_id
    Route::delete('/estate/delete/{estate}', 'EstateController@deleteEstate')->middleware('admin');

    //Admin only Delete Estates by estate_id
    Route::delete('/estate/delete/{estate}', 'EstateController@deleteEstate')->middleware('admin');
    
    //Admin only Update Estates by estate_id
    Route::patch('/estate/{id}', 'EstateController@update')->middleware('admin');

    //Admin only Create a service provider 
    Route::post('/service-provider', 'ServiceProviderController@create')->middleware('admin');

    //Admin only Update a service provider 
    Route::delete('/service-provider/edit/{id}', 'ServiceProviderController@update')->middleware('admin');

    //Admin only delete a specific service provider 
    Route::delete('/service-provider/delete/{id}', 'ServiceProviderController@destroy')->middleware('admin');

    //Refresh token
    Route::post('/refresh', 'Auth\LoginController@refresh');

});



//Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

    //(User Profile)
    //Show active user i.e. current logged in user
    Route::get('/user', 'UserProfileController@index');

    //show one user
    Route::get('/user/{id}', 'UserProfileController@show');

    //Edit user ac count
    Route::put('/user/edit', 'UserProfileController@update');

    //Change Password
    Route::put('/user/password', 'UserProfileController@password');

    //Delete user account
    Route::delete('/user/delete', 'UserProfileController@destroy');


    //(Users interactions with Estates)
    //View Estates
    Route::get('/estates', 'EstateController@index');

    //View Estates
    Route::get('/estate/id/{id}', 'EstateController@show');

    //Get Estates by name
    Route::get('/estate/{name}', 'EstateController@search');

    //View Estates by city
    Route::get('/estate/city/{city}', 'EstateController@showCity');

    //View Estates by country
    Route::get('/estate/country/{country}', 'EstateController@showCountry');

    //Create Estate
    Route::post('/estate', 'EstateController@store');


    //(Users Payment)
    //save payment
    Route::post('/payment', 'PaymentController@postPayment');

    //show all user payment
    Route::get('/payment/user/{user_id}', 'PaymentController@aUserPayment');

    //show payment
    Route::get('/payment/{id}', 'PaymentController@oneUniquePayment');

    //(Users Visitors)
    // Show all visitor
    Route::get('visitor', 'VisitorController@index');

    // Show single visitor
    Route::get('visitor/{id}', 'VisitorController@show');

    // Edit Visitor account
    Route::put('visitor/{id}', 'VisitorController@update');

    // Delete Visitor account
    Route::delete('visitor/{id}', 'VisitorController@destroy');

    //Create a visitor
    Route::post('visitor', 'VisitorController@store');


    //(Users Messging)
    //Get message
    Route::get('messages/{other_user_id}', 'MessageController@conversation');
    //Save Message
    Route::post('/messages', 'MessageController@saveMessage');  

    //(Users And ServiceProvider)
    //Get One
    Route::get('/service-provider/{id}', 'ServiceProviderController@show');

    //Get All Service Provider
    Route::get('/service-provider', 'ServiceProviderController@showAll');
});

//This our testing api routes
Route::get('test', 'TestController@test');
Route::get('generate-code', 'TestController@qrCode');                          

Route::get('init', function () {
    event(new App\Events\notify('Someone'));
    return "Notification sent";
});