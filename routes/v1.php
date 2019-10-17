<?php


//Authentication Routes ******************************************************
    //Registration
    Route::post('register/admin', 'Auth\RegisterController@admin');//has a role of 0

    Route::post('register/resident', 'Auth\RegisterController@resident');//has a role of 1

    Route::post('register/gateman', 'Auth\RegisterController@gateman');//has a role 2

    //forgot Password
    Route::post('phone/verify', 'Auth\ForgotPhoneController@verifyPhone');

    //Verify account
    Route::post('verify', 'Auth\VerificationController@verify');

    //Resend Token
    Route::get('resend/token', 'Auth\ForgotPhoneController@resedToken');

    //Login
    // Route::post('login', 'Auth\LoginController@authenticate'); Not Needed

    //Reset password for a new phone
    // Route::put('phone/reset', 'Auth\ResetPhoneController@reset'); Not  Needed


//Admin Routes (Specific Route)*******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

	//Show all user(this route is for only admin)(admin)
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');

	//Show all user for a particular role(this route is for only admin)(admin)
    Route::get('user/all/{role_id}', 'UserProfileController@role')->middleware('admin');

    //show one admin
    Route::get('admin/{id}', 'UserProfileController@showOneAdmin')->middleware('admin');

    //Delete Estates by estate_id
    Route::delete('/estate/delete/{estate}', 'EstateController@deleteEstate')->middleware('admin');

    //Admin only Update Estates by estate_id
    Route::patch('/estate/{id}', 'EstateController@update')->middleware('admin');

    //Admin only Create a service provider 
    Route::post('/service-provider', 'ServiceProviderController@create')->middleware('admin');

    //Admin only Update a service provider 
    Route::put('/service-provider/edit/{id}', 'ServiceProviderController@update')->middleware('admin');

    //Admin only delete a specific service provider 
    Route::delete('/service-provider/delete/{id}', 'ServiceProviderController@destroy')->middleware('admin');

    // Create a new Service Provider category
    Route::post('/sp-category', 'SPCategoryController@newCategory')->middleware('admin');

    // Edit a Service Provider category
    Route::put('sp-category/{id}', 'SPCategoryController@editCategory')->middleware('admin');

    // Delete a Service Provider category
    Route::delete('sp-category/{id}', 'SPCategoryController@deleteCategory')->middleware('admin');
});



//Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

     //Refresh token
    Route::post('/refresh', 'Auth\LoginController@refresh');

    //(User Profile)
    //Show active user i.e. current logged in user
    Route::get('/user', 'UserProfileController@index');

    //show one user
    Route::get('/user/{id}', 'UserProfileController@show');

    //Edit user ac count
    Route::put('/user/edit', 'UserProfileController@update');

    //Change Password
    Route::put('/user/phone', 'UserProfileController@password');

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

    Route::get('/service-provider/category/{category_id}', 'ServiceProviderController@byCategory');
    /** Resident and Gateman Relationship */
    // Get requests for a gateman
    Route::get('gateman/requests', 'GatemanController@residentRequest')->middleware('checkGateman');

    //gateman Accept/decline invitation 
    Route::put('gateman/response', 'GatemanController@response');

    // Add a gateman 
    Route::post('resident/addGateman/{id}', 'ResidentController@addGateman');

    // remove a gateman by resident 
    Route::delete('resident/removeGateman/{id}', 'ResidentController@destroy');

    // Get gateman by phone
    Route::get('search/gateman/phone/{phone}', 'ResidentController@searchGatemanByPhone');
       
    // Get all Service Provider categories
    Route::get('/sp-category', 'SPCategoryController@fetchCategories');

    // Get gateman by name
    Route::get('search/gateman/name/{name}', 'ResidentController@searchGatemanByName');

    // Show all pending gateman invitation
    Route::get('resident/pending_invitation/', 'ResidentController@pendingInvitation');

    // Show accepted gateman invite
    Route::get('resident/acceptedInvitation/', 'ResidentController@acceptedInvitation');

});

//This our testing api routes
Route::get('test', 'TestController@test');
Route::get('generate-code', 'TestController@qrCode');    
Route::post('image', 'TestController@upload');                       

// Route::get('init', function () {
//     event(new App\Events\notify('Someone'));
//     return "Notification sent";
// });
