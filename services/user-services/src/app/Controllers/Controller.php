<?php
namespace UserService\Controllers;

use DateTime;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class Controller
{
    public function __construct()
    {
    }

    protected function createToken($userId, $username, $isAdmin){
        $now = new DateTime();
        $future = new DateTime("+60 minutes");
        $jti = base64_encode(random_bytes(16));
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => ['id' => $userId, 'username' => $username]
        ];
        $token = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");
        return $token;
    }

    protected function decodeToken($req){
        $input = $req->getHeaders();
        try{
            $token_input = explode(" ", $input["HTTP_AUTHORIZATION"][0]);
        }catch (\Exception $e){
            return false;
        }
        if (!empty($token_input[1])) {
            try{
                return JWT::decode($token_input[1], getenv('JWT_SECRET'), ['HS256']);
            }catch (ExpiredException $e){
                return false;
            }
        }else
            return false;
    }
}