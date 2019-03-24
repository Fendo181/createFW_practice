<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'/core/Request.php';


class RequestTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->request = new Request();
    }

    public function test_リクエストで送られてきたURLからbaseURLを取得する()
    {
        $_SERVER['REQUEST_URI'] = '/foo/bar/list';
        $_SERVER['SCRIPT_NAME'] ='/foo/bar/index.php';

        $baseURL = $this->request->getBaseURL();
        $this->assertEquals('/foo/bar',$baseURL);
    }
}