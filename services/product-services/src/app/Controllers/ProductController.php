<?php
namespace ProductService\Controllers;

use ProductService\Models\Products;
use ProductService\Utilities\Curl;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($req, $res, $args){
        $checkToken = $this->getToken($req);
        try{
            if ($checkToken->isAdmin == 0)
                return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!'], 412);
        } catch (\Exception $e){
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!'], 412);
        }
        $name = $req->getParam('name');
        $description = $req->getParam('description');
        $categoryId = $req->getParam('category_id');

        if (empty($name) || empty($categoryId))
            return $res->withJson(['status' => False]);
        else{
            $token = $this->headerParser($req);
            $curl = Curl::getInstance();
            $category = $curl->getCategory($token, $categoryId);

            if (isset($category->status))
                if ($category->status === false)
                    return $res->withJson(['status' => False, 'description' => 'Kategori id yanlış!'], 412);

            $products = new Products();
            $insertId = $products->create(['name' => $name, 'description' => $description, 'category_id' => $categoryId]);
            if ($insertId !== false)
                return $res->withJson(['id' => $insertId, 'name' => $name, 'isActive' => 1, 'category_id' => $categoryId, 'status' => True]);
            else
                return $res->withJson(['status' => False], 412);
        }
    }

    public function listItem($req, $res, $args){
        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $products = new Products();
            $row = $products->listItem($id);
            if (!empty($row))
                return $res->withJson($row);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function listAll($req, $res, $args){
        $products = new Products();
        $row = $products->listAll();
        if (!empty($row))
            return $res->withJson($row);
        else
            return $res->withJson(['status' => False]);
    }

    public function update($req, $res, $args){
        $checkToken = $this->getToken($req);
        try{
            if ($checkToken->isAdmin == 0)
                return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);
        } catch (\Exception $e){
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);
        }

        $id = $args['id'];
        $name = $req->getParam('name');
        $description = $req->getParam('description');
        $categoryId = $req->getParam('category_id');
        $isActive = $req->getParam('is_active');

        if (empty($id) || empty($name) || empty($categoryId))
            return $res->withJson(['status' => False]);
        else{
            $data = [
                'name' => $name,
                'description' => $description,
                'category_id' => $categoryId
            ];
            if ($isActive !== null)
                $data['is_active'] = $isActive;

            $token = $this->headerParser($req);
            $curl = Curl::getInstance();
            $category = $curl->getCategory($token, $categoryId);

            if (isset($category->status))
                if ($category->status === false)
                    return $res->withJson(['status' => False, 'description' => 'Kategori id yanlış!']);

            $products = new Products();
            $row = $products->update($id, $data);
            if (!empty($row))
                return $res->withJson($row);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function delete($req, $res, $args){
        $checkToken = $this->getToken($req);
        try{
            if ($checkToken->isAdmin == 0)
                return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);
        } catch (\Exception $e){
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);
        }

        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $products = new Products();
            $row = $products->delete($id);
            if (!empty($row))
                return $res->withJson(['status' => True]);
            else
                return $res->withJson(['status' => False]);
        }
    }
}