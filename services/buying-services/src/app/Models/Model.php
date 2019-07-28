<?php
namespace BuyingService\Models;

class Model
{
    protected $postgres = null;

    public function __construct()
    {
        $dsn = 'pgsql:host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE');
        $usr = getenv('DB_USERNAME');
        $pwd = getenv('DB_PASSWORD');

        $this->postgres = new \FaaPz\PDO\Database($dsn, $usr, $pwd);
    }
}