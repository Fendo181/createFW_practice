<?php
require_once '../bootstrap.php';
require_once '../BbsApplication.php';

$debugMode = true;
$app = new BbsApplication($debugMode);
$app->run();