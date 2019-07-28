<?php
namespace CategoryService\Controllers;

use CategoryService\Utilities\Curl;

class Controller
{
    public function __construct()
    {
    }

    protected function getToken($req){
        $input = $req->getHeaders();
        try{
            $token_input = explode(" ", $input["HTTP_AUTHORIZATION"][0]);

            if (!empty($token_input[1])){
                $curl = Curl::getInstance();
                $checkToken = $curl->getCheckToken($token_input[1]);
                if ($checkToken->isAdmin == 0)
                    die(\GuzzleHttp\json_encode(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']));
            } else
                die(\GuzzleHttp\json_encode(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']));
        }catch (\Exception $e){
            return false;
        }
    }

}