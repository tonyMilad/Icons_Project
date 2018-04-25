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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    //part 1
    // login and registration
    Route::post('login','LoginController@Login');
    Route::post('register ','RegistrationController@registerUser');

    //part 2 
    // Creating, Editing & Deleting
    Route::post('urls','UrlController@addUrl');
    Route::get('urls','UrlController@url');
    Route::put('urls', 'UrlController@updateUrl');
    Route::delete('urls', 'UrlController@deletById');

    // registration
    // Route::post('user', ['uses' => 'RegistrationController@registerUser']);//creating a new user
    // Route::post('user/verification/phone', ['uses' => 'RegistrationController@phoneVerification']);//verifying phone number
    // Route::post('user/details', ['uses' => 'RegistrationController@completeRegistration']);//completeing user details
    // Route::get('user/verification/mail/{token}', ['uses' => 'RegistrationController@emailVerification']);//verifying email address
    // Route::post('user/pin', ['uses' => 'RegistrationController@choosePinCode']);//chosing user pin code
    // Route::get('user/pin', ['uses' => 'RegistrationController@resendPin']);//resend pin code sms

    // //login
    // Route::post('user/phone', ['uses' => 'LoginController@login']);//login using phone number
    // Route::post('user/verification/phone/login', ['uses' => 'LoginController@phoneVerification']);//complete login verifying sms pin code
    // Route::post('user/pin/check', ['uses' => 'LoginController@checkPinCode']);//check user's pin code

    // //forget Pincode
    // Route::post('user/forget/pin/phone', ['uses' => 'ForgetPinController@userPhone']);//takes phone number to get user
    // Route::post('user/forget/pin/verification/phone', ['uses' => 'ForgetPinController@phoneVerification']);//verifies otp sent to phone
    // Route::post('user/forget/pin/password/check', ['uses' => 'ForgetPinController@checkPassword']);//check password matches
    // Route::get('user/forget/pin', ['uses' => 'ForgetPinController@resendPin']);//resend otp to phone number
    // Route::post('user/forget/pin', ['uses' => 'ForgetPinController@choosePinCode']);//change pin code

});
