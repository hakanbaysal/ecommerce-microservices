<?php
namespace CategoryService\Utilities;

class Curl
{
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => 'http://user-service/']);
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
        if($redis->addQueue(json_encode([$token]))) {
            $res = $this->client->request('GET', 'user/checkToken', ['headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]]);

            return json_decode($res->getBody());
        } else
            return false;
    }
}