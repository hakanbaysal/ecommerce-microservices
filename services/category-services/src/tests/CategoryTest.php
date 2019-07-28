<?php
namespace Tests;

class CategoryTest extends BaseTest
{
    public function testBaseRoute() {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateSuccess() {
        $response = $this->runApp('POST', '/category/', ['name'=>'test', 'is_active' => 1]);
        $result = json_decode($response->getBody(), true);
        $this->assertNotNull($result['id']);
        $this->assertSame($response->getStatusCode(), 200);
    }

    public function testCreateFailure() {
        $response = $this->runApp('POST', '/category/', ['nametest'=>'test', 'is_active' => 1]);
        $result = json_decode($response->getBody(), true);
        $this->assertFalse(isset($result['id']));
        $this->assertSame($response->getStatusCode(), 412);
    }
}