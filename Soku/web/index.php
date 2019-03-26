<?php

require_once '../bootstrap.php';
require_once '../PostApplication.php';

echo 'This Soku FW';

$debug = true;
//
$app = new PostApplication($debug);
$app->run();


