<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //
    function Login(Request $request){

    	 try{
            if(!$request->has('username') && !$request->has('password')){
              //request params missing
              return response()->json([
                'status' => 'failure',
                'message' => "Request Missing params. ('username', 'password')",
              ], 200);
            }

            $username = $request->input('username');
            $password = $request->input('password');

            $user = User::where('username', '=', $username)->first();


            if(!$user){
              //no user found
              return response()->json([
                'status' => 'failure',
                'message' => "User not found.",
              ], 200);
            }

            //generate token
            $token = TokenController::generateToken($user);

            //return token
            return response()->json([
              'status' => 'success',
              'message' => "success",
              "token" => $token
            ], 200);

        }catch(\Exception $ex){
            Log::info('exception: ');
            Log::info($ex->getMessage());
            Log::info($ex);

            return response()->json([
                'status' => 'failure',
                'message' => 'Something Went Wrong',
                'info' => $ex->getMessage()
            ], 200);
        }

    }



}
