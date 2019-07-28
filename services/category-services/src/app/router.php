<?php

use CategoryService\Controllers\CategoryController;

$app->get('/', function ($request, $response, $args) {
    return $this->response->write('category-services');
});

$app->group('/category', function ($app) {
    $this->post('/', CategoryController::class.':create');
    $this->get('/', CategoryController::class.':listAll');
    $this->get('/{id}', CategoryController::class.':listItem');
    $this->put('/{id}', CategoryController::class.':update');
    $this->delete('/{id}', CategoryController::class.':delete');
});