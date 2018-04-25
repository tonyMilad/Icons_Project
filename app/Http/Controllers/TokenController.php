<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuthExceptions\JWTException;

class TokenController extends Controller
{

    public static function generateToken($user){
        return JWTAuth::fromUser($user);
    }

    public static function generateTokenWithCustomClaims($user, $customClaims)
    {
        // $defaultClaims = ["id" => $user->id, "type" => "default"];

        // $claims = array_merge($defaultClaims, $customClaims);

        // $payload = JWTFactory::make($claims);
        // $secret = "";

        // // $token = JWTAuth::encode($payload, $secret, "HS256");
        // $token = JWTAuth::fromUser($user, $claims);

        // return $token;
    }


    public static function getTokenData($token)
    {
        $payload = JWTAuth::getPayload($token);
        return $payload;
    }

    

}
