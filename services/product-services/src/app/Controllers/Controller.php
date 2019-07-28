<?php
namespace ProductService\Controllers;

use ProductService\Utilities\Curl;
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
}