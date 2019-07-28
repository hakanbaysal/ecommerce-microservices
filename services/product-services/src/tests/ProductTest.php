<?php
namespace Tests;

class ProductTest extends BaseTest
{
    public function testBaseRoute() {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateSuccess() {
        $response = $this->runApp('POST', '/product/', ['name'=>'test','description'=>'test','category_id' => 1]);
        $result = json_decode($response->getBody(), true);
        $this->assertNotNull($result['id']);
        $this->assertSame($response->getStatusCode(), 200);
    }

    public function testCreateFailure() {
        $response = $this->runApp('POST', '/product/', ['name'=>'test','description'=>'test','category_id' => 1111]);
        $result = json_decode($response->getBody(), true);
        $this->assertFalse(isset($result['id']));
        $this->assertSame($response->getStatusCode(), 412);
    }
}