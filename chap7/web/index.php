<?php

require_once '../bootstrap.php';
require_once '../BbsApplication.php';

$debugMode = false;

$app = new BbsApplication($debug);
$app->run();