<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'/core/ClassLoader.php';

class ClassLoaderTest extends TestCase
{
    protected $loader;

    public function setUp(): void
    {
        $this->loader = new ClassLoader();
    }

    public function test_registerDir()
    {
        $coreClassFilePath = '/Users/endu/src/fendo181/mvcfw/chap7/core';
        $viewClassFilePath = '/Users/endu/src/fendo181/mvcfw/chap7/view';

        $this->loader->registerDir($coreClassFilePath);
        $this->loader->registerDir($viewClassFilePath);

        $this->assertEquals('/Users/endu/src/fendo181/mvcfw/chap7/core',$this->loader->getDir()['0']);
        $this->assertEquals('/Users/endu/src/fendo181/mvcfw/chap7/view',$this->loader->getDir()['1']);
    }

}