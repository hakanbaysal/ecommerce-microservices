<?php
namespace UserService\Models;

class Users extends Model
{
    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
    }

    public function create($data){
        $insertStatement = $this->postgres->insert($data)->into($this->tableName);
        $insertId = $insertStatement->execute();

        if ($insertId !== false)
            return $insertId;
        else
            return false;
    }

    public function login($data){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where("username", "=", $data['username'])
            ->where("is_active", "=", 1);
        $stmt = $selectStatement->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function checkToken($data){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where("id", "=", $data['id'])
            ->where("username", "=", $data['username']);
        $stmt = $selectStatement->execute();
        $data = $stmt->fetch();

        return $data;
    }
}

