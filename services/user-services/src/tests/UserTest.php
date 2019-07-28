<?php
namespace Tests;

class UserTest extends BaseTest
{
    public function testBaseRoute() {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUserLoginSuccess() {
        $response = $this->runApp('POST', '/user/login', ['username'=>'username','password'=>'123456']);
        $result = json_decode($response->getBody(), true);
        $this->assertNotNull($result['token']);
        $this->assertSame($response->getStatusCode(), 200);
    }

    public function testUserLoginFailure() {
        $response = $this->runApp('POST', '/user/login', ['username'=>'error','password'=>'error']);
        $result = json_decode($response->getBody(), true);
        $this->assertFalse(isset($result['token']));
        $this->assertSame($response->getStatusCode(), 401);
    }
}