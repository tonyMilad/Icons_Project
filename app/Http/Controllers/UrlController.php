<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuthExceptions\JWTException;

use Illuminate\Http\Request;
use App\User;
use App\Url;

class UrlController extends Controller
{
    function url(Request $request){
        $req=$request->input('id');
        if($request->has('id')){
            return $this->urlById($req);
        }else{
            return $this->showUserUrl($request);
        }
    }

	function showUserUrl(Request $request){
		try {
			if(!$user = JWTAuth::parseToken()->toUser()){
              //no user found
              return response()->json([
                'message' => "User not found.",
              ], 404);
            }

            //generate token
      		$token = TokenController::generateToken($user);

      		//return token
      		return response()->json([
      			'status' => 'success',
        		'message' => "success",
        		'Urls' => $user->urls()->get(),
        		'token' => $token
        	], 200);
			
		} catch (\Exception $ex) {
			return response()->json([
      			'status' => 'failure',
      			'message' => 'Something Went Wrong',
      			'info' => $ex->getMessage(),
      		], 200);
			
		}
    }
    
    function addUrl(Request $request){
    	try {
    		if(!$user = JWTAuth::parseToken()->toUser()){
              //no user found
              return response()->json([
                'message' => "User not found.",
              ], 404);
            }

            //check for mssing parameters
            if(!$request->has('url')){
    		//phone param is missing
    			return response()->json([
    				'status' => 'failure',
    				'message' => "Request Url params."
    			], 200);
    		}

    		//save url;
    		$url =new Url(['url' => $request->input('url'),'status'=>'none']);
    		$user->urls()->save($url);

    		//generate token
      		$token = TokenController::generateToken($user);

      		//return token
      		return response()->json([
      			'status' => 'success',
        		'message' => "success",
        		'token' => $token
        	], 200);
    		
    	} catch (\Exception $ex) {

    		return response()->json([
      			'status' => 'failure',
      			'message' => 'Something Went Wrong',
      			'info' => $ex->getMessage(),
      		], 200);
    		
    	}

    }//end of funcation addUrl

  public function urlById($id){
      try {
          if(!$user = JWTAuth::parseToken()->toUser()){
              //no user found
              return response()->json([
                  'message' => "User not found.",
              ], 404);
          }

          //generate token
          $token = TokenController::generateToken($user);

          //return token
          return response()->json([
              'status' => 'success',
              'message' => "success",
              'Urls' => Url::where('id',$id)->get(),
              'token' => $token
          ], 200);
      	
      } catch (\Exception $ex) {
      	return response()->json([
      			'status' => 'failure',
      			'message' => 'Something Went Wrong',
      			'info' => $ex->getMessage(),
      		], 200);
      }
  }
  function deletById(Request $request){
        try{
            if(!$user = JWTAuth::parseToken()->toUser()){
                //no user found
                return response()->json([
                    'message' => "User not found.",
                ], 404);
            }

            //generate token
            $token = TokenController::generateToken($user);
            $url=Url::where('id',$request->input('id'));
            $url->delete();

            //return token
            return response()->json([
                'status' => 'success',
                'message' => "success",
                'token' => $token
            ], 200);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 'failure',
                'message' => 'Something Went Wrong',
                'info' => $ex->getMessage(),
            ], 200);
        }
  }

  function updateUrl(Request $request){
        try{
            if(!$user = JWTAuth::parseToken()->toUser()){
                //no user found
                return response()->json([
                    'message' => "User not found.",
                ], 404);
            }

            $token = TokenController::generateToken($user);
            $url =Url::where('id',$request->input('id'))->first();
            $url->url=$request->input('url');
            $url->save();


            //return token
            return response()->json([
                'status' => 'success',
                'message' => "success updated",
                'url'=>$url,
                'token' => $token
            ], 200);


        }catch (\Exception $ex){
            return response()->json([
                'status' => 'failure',
                'message' => 'Something Went Wrong',
                'info' => $ex->getMessage(),
            ], 200);
        }
  }

}
