<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuthExceptions\JWTException;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\TokenController;

class RegistrationController extends Controller
{
    //
    function registerUser(Request $request){
    	try{
    		if(!$request->has('email')|| !$request->has('username')|| !$request->has('password')){
    		//phone param is missing
    			return response()->json([
    				'status' => 'failure',
    				'message' => "Request Missing params."
    			], 200);
    		}


    		$email = $request->input('email');
      	$username = $request->input('username');
      	$password = $request->input('password');
      	$user_exists = false;// defaults to false it is a new account



      		if (User::isEmailDublicate($email)) {
      		// account already exists
      			$user_exists = true;
      			if($user = User::where('email', '=', $email)->first()){
      			//no user found - some error happened
      				return response()->json([
      					'status' => 'failure',
      					'message' => "email is Dublicate.",
      				], 200);
      			}

      		}

      		//Create new user with the phone no
      		$user = new User;
          $user->username=$username;
          $user->email=$email;
          $user->password=$password;
          //saving user record
          $user->save();
            //generate token
            $token = TokenController::generateToken($user);

      		//return token
      		return response()->json([
      			'status' => 'success',
        		'message' => "success",
        		'token' => $token
        	], 200);
      	}catch(\Exception $ex){

      		return response()->json([
      			'status' => 'failure',
      			'message' => 'Something Went Wrong',
      			'info' => $ex->getMessage(),
      		], 200);
      	}
    }
}
