<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'/core/Router.php';


class RouterTest extends TestCase {

    protected $routeDefinitions;

    public function setUp(): void
    {
        // ルーティング設定
        $this->routeDefinitions = [
            'user/:id' => [
                'controller' => 'user',
                'action' => 'edit'
            ]
        ];

        $this->routes = new Router($this->routeDefinitions);
    }

    public function test_compileRoutes()
    {
        $this->assertArrayHasKey('/user/(?P<id>[^/]+)', $this->routes->getRouter());
        $this->assertEquals('user',$this->routes->getRouter()['/user/(?P<id>[^/]+)']['controller']);
        $this->assertEquals('edit',$this->routes->getRouter()['/user/(?P<id>[^/]+)']['action']);
    }
}