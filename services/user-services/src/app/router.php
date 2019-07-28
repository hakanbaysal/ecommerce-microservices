<?php

use UserService\Controllers\UserController;

$app->get('/', function ($request, $response, $args) {
    return $this->response->write('user-services');
});

$app->group('/user', function ($app) {
    $this->post('/register', UserController::class.':register');
    $this->post('/login', UserController::class.':login');
    $this->get('/checkToken', UserController::class.':checkToken');
});
