<?php
namespace BuyingService\Models;

class Buyings extends Model
{
    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'buyings';
    }

    public function create($data){
        $insertStatement = $this->postgres->insert($data)->into($this->tableName);
//        pp($insertStatement->__toString(),1);
        $insertId = $insertStatement->execute();

        if ($insertId !== false)
            return $insertId;
        else
            return false;
    }

    public function listItem($id){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where("id", "=", $id)
            ->where("status", "<>", 0);
        $stmt = $selectStatement->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function listAll(){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where("status", "<>", 0);
        $stmt = $selectStatement->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function update($id, $username, $data){
        $updateStatement = $this->postgres->update($data)->table($this->tableName)
            ->where("id", "=", $id)
            ->where("username", "=", $username);
        $affectedRows = $updateStatement->execute();

        if (!empty($affectedRows))
            return $this->listItem($id);

        return false;
    }

    public function delete($id, $username){
        $updateStatement = $this->postgres->update(['status' => 0])->table($this->tableName)
            ->where("id", "=", $id)
            ->where("username", "=", $username);
        $affectedRows = $updateStatement->execute();

        return $affectedRows;
    }

    public function forceDelete($id, $username){
        $deleteStatement = $this->postgres->delete()->from($this->tableName)
            ->where("id", "=", $id)
            ->where("username", "=", $username);
        $affectedRows = $deleteStatement->execute();

        return $affectedRows;
    }
}

