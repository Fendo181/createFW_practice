<?php

require dirname(__DIR__)."/vendor/autoload.php";
require 'core/ClassLoader.php';

$app = new \Illuminate\Container\Container;

$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');
$loader->registerDir(dirname(__FILE__).'/exceptions');
$loader->register();