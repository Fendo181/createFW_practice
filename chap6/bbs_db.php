<?php
// 一個階層が上のvendorディレクトリを指定する
define('DIR_VENDOR', dirname(__DIR__) .'/vendor/');

// vendorディレクトリからautoload.phpを呼び出して実行する
require_once(DIR_VENDOR . 'autoload.php');

// ref:https://github.com/vlucas/phpdotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$dsn = getenv('DB_DSN');
$user = getenv('DB_USER');
$password =getenv('DB_PASS');

try {
    $pdo = new PDO($dsn, $user, $password);
    echo  '接続できました!';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
