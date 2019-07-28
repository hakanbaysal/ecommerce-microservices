<?php

use BuyingService\Controllers\BuyingController;

$app->get('/', function ($request, $response, $args) {
    return $this->response->write('buying-services');
});

$app->group('/buying', function ($app) {
    $this->post('/{productId}', BuyingController::class.':create');
    $this->get('/', BuyingController::class.':listAll');
    $this->get('/{id}', BuyingController::class.':listItem');
    $this->put('/{id}', BuyingController::class.':update');
    $this->delete('/{id}', BuyingController::class.':delete');
});