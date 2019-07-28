<?php

use ProductService\Controllers\ProductController;

$app->get('/', function ($request, $response, $args) {
    return $this->response->write('product-services');
});

$app->group('/product', function ($app) {
    $this->post('/', ProductController::class.':create');
    $this->get('/', ProductController::class.':listAll');
    $this->get('/{id}', ProductController::class.':listItem');
    $this->put('/{id}', ProductController::class.':update');
    $this->delete('/{id}', ProductController::class.':delete');
});