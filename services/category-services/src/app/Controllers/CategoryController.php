<?php
namespace CategoryService\Controllers;

use CategoryService\Models\Categories;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($req, $res, $args){
        $this->getToken($req);
        $name = $req->getParam('name');

        if (empty($name))
            return $res->withJson(['status' => False], 412);
        else{
            $categories = new Categories();
            $insertId = $categories->create(['name' => $name, 'is_active' => 1]);
            if ($insertId !== false)
                return $res->withJson(['id' => $insertId, 'name' => $name, 'isActive' => 1, 'status' => True]);
            else
                return $res->withJson(['status' => False], 412);
        }
    }

    public function listItem($req, $res, $args){
        $this->getToken($req);
        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $categories = new Categories();
            $row = $categories->listItem($id);
            if (!empty($row))
                return $res->withJson($row);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function listAll($req, $res, $args){
        $this->getToken($req);
        $categories = new Categories();
        $row = $categories->listAll();
        if (!empty($row))
            return $res->withJson($row);
        else
            return $res->withJson(['status' => False]);
    }

    public function update($req, $res, $args){
        $this->getToken($req);
        $id = $args['id'];
        $name = $req->getParam('name');
        $isActive = $req->getParam('is_active');

        if (empty($id) || empty($name))
            return $res->withJson(['status' => False]);
        else{
            $data = ['name' => $name];
            if ($isActive !== null)
                $data['is_active'] = $isActive;

            $categories = new Categories();
            $row = $categories->update($id, $data);
            if (!empty($row))
                return $res->withJson($row);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function delete($req, $res, $args){
        $this->getToken($req);
        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $categories = new Categories();
            $row = $categories->delete($id);
            if (!empty($row))
                return $res->withJson(['status' => True]);
            else
                return $res->withJson(['status' => False]);
        }
    }
}