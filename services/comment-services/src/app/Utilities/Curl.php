<?php
namespace CommentService\Utilities;

class Curl
{
    public function __construct()
    {
    }

    public static function getInstance(){
        static $inst = null;

        if ($inst === null)
            $inst = new Curl();

        return $inst;
    }

    public function getCheckToken($token){
        $redis = Redis::getInstance();
        $redis->queueName = 'user-service';
        if($redis->addQueue(json_encode([$token]))){
            $client = new \GuzzleHttp\Client(['base_uri' => 'http://user-service/']);
            $res = $client->request('GET', 'user/checkToken', ['headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]]);

            return json_decode($res->getBody());
        } else
            return false;
    }

    public function getProduct($token, $productId){
        $redis = Redis::getInstance();
        $redis->queueName = 'product-service';
        if($redis->addQueue(json_encode([$token, $productId]))){
            $client = new \GuzzleHttp\Client(['base_uri' => 'http://product-service/']);
            $res = $client->request('GET', 'product/' . $productId, ['headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]]);

            return json_decode($res->getBody());
        } else
            return false;
    }
}