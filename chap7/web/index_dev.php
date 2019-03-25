<?php

require_once '../bootstrap.php';
require_once '../BbsApplication.php';

$debug = true;

$app = new BbsApplication($debug);
$app->run();