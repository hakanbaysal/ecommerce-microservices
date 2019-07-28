<?php
namespace ProductService\Utilities;

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
                'Authorization' => 'Bearer '.$token
            ]]);

            return json_decode($res->getBody());
        } else
            return false;
    }

    public function getCategory($token, $categoryId){
        $redis = Redis::getInstance();
        $redis->queueName = 'category-service';
        if($redis->addQueue(json_encode([$token, $categoryId]))){
            $client = new \GuzzleHttp\Client(['base_uri' => 'http://category-service/']);
            $res = $client->request('GET', 'category/'.$categoryId, ['headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]]);

            return json_decode($res->getBody());
        } else
            return false;
    }
}