<?php
namespace CommentService\Models;

class Comments extends Model
{
    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'comments';
    }

    public function create($data){
        $insertStatement = $this->postgres->insert($data)->into($this->tableName);
        $insertId = $insertStatement->execute();

        if ($insertId !== false)
            return $insertId;
        else
            return false;
    }

    public function listItem($id){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where("id", "=", $id)
            ->where("is_active", "=", 1);
        $stmt = $selectStatement->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function listAll($productId){
        $selectStatement = $this->postgres->select()->from($this->tableName)
            ->where('product_id', '=', $productId)
            ->where("is_active", "=", 1);
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
        $updateStatement = $this->postgres->update(['is_active' => 0])->table($this->tableName)
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

