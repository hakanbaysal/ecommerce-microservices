<?php
namespace CategoryService\Utilities;

class Redis
{
    private $redisQueue;
    private $redisConfig;
    public $queueName;

    public function __construct()
    {
        $this->queueName = getenv('REDIS_QUEUE');
        $this->redisConfig = [
            'host' => getenv('REDIS_HOST'),
            'auth' => getenv('REDIS_USERNAME'),
            'port' => getenv('REDIS_PORT'),
            'index' => getenv('REDIS_DB')
        ];
    }

    public static function getInstance(){
        static $inst = null;

        if ($inst === null)
            $inst = new Redis();

        return $inst;
    }

    public function addQueue($data){
        try {
            $this->redisQueue = new RedisQueue($this->queueName, $this->redisConfig);

            $index = $this->redisQueue->add($data);
            if($this->listenQueue($index)){
                return true;
            }
        } catch (RedisQueueException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function listenQueue($controlIndex){
        while (True){
            try {
                $this->redisQueue = new RedisQueue($this->queueName, $this->redisConfig);

                $data = $this->redisQueue->get();
                $currentIndex = $this->redisQueue->getCurrentIndex($data);

                if ($currentIndex == $controlIndex) {
                    $ret = $this->redisQueue->remove($data);
                    if (!empty($ret))
                        return true;
                    else
                        return false;
                }
                /*else {
                    $this->redisQueue->rollback($data);
                    return false;
                }*/
            } catch (RedisQueueException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function statusQueue(){
        try {
            $this->redisQueue = new RedisQueue($this->queueName, $this->redisConfig);

            return $this->redisQueue->status();
        } catch (RedisQueueException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}