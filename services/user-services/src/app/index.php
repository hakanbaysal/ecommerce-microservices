<?php
header('Content-Type: application/json');

function pp($val, $isDie = 0, $isVarDump = 0)
{
    if ($isVarDump != 0)
        var_dump($val);
    else {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
    if ($isDie != 0)
        die;
}

require __DIR__ . '/../vendor/autoload.php';
session_start();

use Dotenv\Dotenv;
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = new Dotenv(__DIR__ . '/../');
    $dotenv->load();
}

$app = new \Slim\App();
require __DIR__ . '/router.php';

Sentry\init(['dsn' => 'https://d261854f86ce4b8caa371077a475fc67@sentry.io/1514841' ]);

function exception_error_handler($errno, $errstr, $errfile, $errline) {
    throw new Exception(json_encode([$errno, $errstr, $errfile, $errline]));
    die(\GuzzleHttp\json_encode(['error' => '500 Internal Server Error!']));
}
set_error_handler('exception_error_handler');

$app->run();