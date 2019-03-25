<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'/core/Response.php';

class ResponseTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->response = new Response();
    }

    // Todo Add function send Test Code
}