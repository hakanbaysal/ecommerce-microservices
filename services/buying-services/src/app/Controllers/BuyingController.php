<?php
namespace BuyingService\Controllers;

use BuyingService\Models\Buyings;
use BuyingService\Utilities\Curl;

class BuyingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($req, $res, $args){
        $checkToken = $this->getToken($req);
        if (empty($checkToken))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!'], 412);

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Bir hata oluştu!'], 412);

        $productId = $args['productId'];

        if (empty($productId))
            return $res->withJson(['status' => False], 412);
        else{
            $bearer = $this->headerParser($req);
            $curl = Curl::getInstance();
            $product = $curl->getProduct($bearer, $productId);

            if (isset($product->status))
                if ($product->status === false)
                    return $res->withJson(['status' => False, 'description' => 'Ürün id yanlış!'], 412);

            $buyings = new Buyings();
            $insertId = $buyings->create(['username' => $token->sub->username, 'product_id' => $product->id, 'status' => 1]);
            if ($insertId !== false)
                return $res->withJson(['id' => $insertId, 'username' => $token->sub->username, 'product_id' => $product->id, 'status' => 1]);
            else
                return $res->withJson(['status' => False], 412);
        }
    }

    public function listAll($req, $res, $args){
        $checkToken = $this->getToken($req);
        if (empty($checkToken))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $buyings = new Buyings();
        $row = $buyings->listAll();
        if (!empty($row))
            return $res->withJson($row);
        else
            return $res->withJson(['status' => False]);
    }

    public function listItem($req, $res, $args){
        $checkToken = $this->getToken($req);
        if (empty($checkToken))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);

        $buyings = new Buyings();
        $row = $buyings->listItem($id);
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

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Geçersiz token!']);

        $id = $args['id'];
        $status = $req->getParam('status');

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $data = [];
            if ($status !== null) {
                $data['status'] = $status;

                $buyings = new Buyings();
                $row = $buyings->update($id, $token->sub->username, $data);
                if (!empty($row))
                    return $res->withJson($row);
                else
                    return $res->withJson(['status' => False]);
            } else
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

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Geçersiz token!']);

        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $buyings = new Buyings();
            $row = $buyings->delete($id, $token->sub->username);
            if (!empty($row))
                return $res->withJson(['status' => True]);
            else
                return $res->withJson(['status' => False]);
        }
    }
}