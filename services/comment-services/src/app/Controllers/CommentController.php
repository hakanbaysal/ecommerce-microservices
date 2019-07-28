<?php
namespace CommentService\Controllers;

use CommentService\Models\Comments;
use CommentService\Utilities\Curl;

class CommentController extends Controller
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

        $comment = $req->getParam('comment');
        $productId = $args['productId'];

        if (empty($comment) || empty($productId))
            return $res->withJson(['status' => False]);
        else{
            $bearer = $this->headerParser($req);
            $curl = Curl::getInstance();
            $product = $curl->getProduct($bearer, $productId);

            if (isset($product->status))
                if ($product->status === false)
                    return $res->withJson(['status' => False, 'description' => 'Ürün id yanlış!'], 412);

            $comments = new Comments();
            $insertId = $comments->create(['username' => $token->sub->username, 'comment' => $comment, 'product_id' => $product->id]);
            if ($insertId !== false)
                return $res->withJson(['id' => $insertId, 'username' => $token->sub->username, 'comment' => $comment, 'product_id' => $product->id, 'is_active' => 1, 'status' => True]);
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

        $productId = $args['productId'];

        if (empty($productId))
            return $res->withJson(['status' => False]);

        $comments = new Comments();
        $row = $comments->listAll($productId);
        if (!empty($row))
            return $res->withJson($row);
        else
            return $res->withJson(['status' => False]);
    }

    public function update($req, $res, $args){
        $checkToken = $this->getToken($req);
        if (empty($checkToken))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Geçersiz token!']);

        $id = $args['id'];
        $comment = $req->getParam('comment');
        $isActive = $req->getParam('is_active');

        if (empty($id) || empty($comment))
            return $res->withJson(['status' => False]);
        else{
            $data = [
                'comment' => $comment
            ];
            if ($isActive !== null)
                $data['is_active'] = $isActive;

            $comments = new Comments();
            $row = $comments->update($id, $token->sub->username, $data);
            if (!empty($row))
                return $res->withJson($row);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function delete($req, $res, $args){
        $checkToken = $this->getToken($req);
        if (empty($checkToken))
            return $res->withJson(['status' => False, 'description' => 'Yetkiniz bulunmamaktadır!']);

        $token = $this->decodeToken($req);
        if (empty($token->sub))
            return $res->withJson(['status' => False, 'description' => 'Geçersiz token!']);

        $id = $args['id'];

        if (empty($id))
            return $res->withJson(['status' => False]);
        else{
            $comments = new Comments();
            $row = $comments->delete($id, $token->sub->username);
            if (!empty($row))
                return $res->withJson(['status' => True]);
            else
                return $res->withJson(['status' => False]);
        }
    }
}