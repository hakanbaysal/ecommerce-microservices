<?php
namespace BuyingService\Controllers;

use BuyingService\Utilities\Curl;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class Controller
{
    public function __construct()
    {
    }

    protected function headerParser($req){
        $input = $req->getHeaders();
        try{
            $token_input = explode(" ", $input["HTTP_AUTHORIZATION"][0]);
        }catch (\Exception $e){
            return false;
        }
        if (!empty($token_input[1]))
            return $token_input[1];

        return false;
    }

    protected function getToken($req){
        $token = $this->headerParser($req);
        if (!empty($token)){
            $curl = Curl::getInstance();
            return $curl->getCheckToken($token);
        } else
            die(\GuzzleHttp\json_encode(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']));
    }

    protected function decodeToken($req) {
        $token = $this->headerParser($req);
        if (!empty($token)){
            try{
                return JWT::decode($token, getenv('JWT_SECRET'), ['HS256']);
            }catch (ExpiredException $e){
                return false;
            }
        }else
            return false;
    }
}