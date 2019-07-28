<?php
namespace UserService\Controllers;

use DateTime;
use UserService\Models\Users;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($req, $res, $args){
        $token = $this->decodeToken($req);
        $username = $req->getParam('username');
        $password = $req->getParam('password');
        $isAdmin = $req->getParam('isAdmin');

        if (empty($username) || empty($password)){
            return $res->withJson(['status' => False]);
        }else{
            $checkToken = $this->checkTokenProcess($token);
            if (empty($checkToken) || $checkToken['is_admin'] == 0)
                $isAdmin = 0;

            $users = new Users();
            $insertId = $users->create(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'is_admin' => $isAdmin]);
            if ($insertId !== false)
                return $res->withJson(['id' => $insertId, 'username' => $username, 'password' => $password, 'isAdmin' => $isAdmin, 'status' => True]);
            else
                return $res->withJson(['status' => False]);
        }
    }

    public function login($req, $res, $args){
        $username = $req->getParam('username');
        $password = $req->getParam('password');

        if (empty($username) || empty($password)){
            return $res->withJson(['status' => False, 'description' => 'Kullanıcı adı veya şifre boş bırakılamaz!'], 400);
        }else{
            $users = new Users();
            $row = $users->login(['username' => $username]);
            if (!empty($row)){
                if (password_verify($password, $row['password'])){
                    $token = $this->createToken($row['id'], $row['username'], $row['is_admin']);
                    return $res->withJson(['status' => True, 'username' => $row['username'], 'token' => $token]);
                }else{
                    return $res->withJson(['status' => False, 'description' => 'Şifre yanlış!'], 401);
                }
            }else{
                return $res->withJson(['status' => False, 'description' => 'Kullanıcı adı yanlış!'], 401);
            }
        }
    }

    public function checkToken($req, $res, $args){
        $token = $this->decodeToken($req);
        if (empty($token))
            return $res->withJson(['status' => False]);
        else {
            $checkToken = $this->checkTokenProcess($token);
            if ($checkToken)
                return $res->withJson(['status' => True, 'isAdmin' => $checkToken['is_admin']]);
            else
                return $res->withJson(['status' => False, 'description' => 'Geçersiz token!']);
        }
    }

    private function checkTokenProcess($token){
        $now = new DateTime();
        try{
            if ($now->getTimestamp() >= $token->exp)
                return false;
            else {
                $users = new Users();
                $row = $users->checkToken(['id' => $token->sub->id, 'username' => $token->sub->username]);
                if (!empty($row))
                    return $row;
                else
                    return false;
            }
        }catch (\Exception $e){
            return false;
        }
    }
}