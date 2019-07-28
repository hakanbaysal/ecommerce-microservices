<?php

use CommentService\Controllers\CommentController;

$app->get('/', function ($request, $response, $args) {
    return $this->response->write('comment-services');
});

$app->group('/comment', function ($app) {
    $this->post('/{productId}', CommentController::class.':create');
    $this->get('/{productId}', CommentController::class.':listAll');
    $this->put('/{id}', CommentController::class.':update');
    $this->delete('/{id}', CommentController::class.':delete');
});