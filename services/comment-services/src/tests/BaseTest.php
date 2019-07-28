<?php
namespace Tests;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );
        $request = Request::createFromEnvironment($environment);
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }
        $response = new Response();
        $app = new App();
        $response = $app->process($request, $response);
        return $response;
    }
}