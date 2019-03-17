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

$erros = [];

// POSTなら保存処理を行う
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 名前が正しく入力されているかチェック
    $name = null;

    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $erros['name'] = '名前を入力して下さい';
    } else if (strlen($_POST['name']) > 40) {
        $erros['name'] = '名前を40文字以内で入力して下さい';
    } else {
        $name = $_POST['name'];
    }

    // 一言が正しく入力されているかチェックする
    $comment = null;

    if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $erros['comment'] = 'コメントを';
    } else if (strlen($_POST['name']) > 200) {
        $erros['comment'] = 'ひとことは200文字以内で入力して下さい';
    } else {
        $name = $_POST['name'];
    }

    //エラーがなければ保存する
    if (count($erros) > 0) {
        $sql = "INSERT INTO bbs_online (
            `name`, `comment`, `created_at` 
        ) VALUES (
            $name, '$comment', 'date('Y-m-d H:i:s')'
        )";
        $res = $pdo->query($sql);
    }
}

?>


<html>
<head>
    <title>
        一言掲示板
    </title>
</head>
<body>
    <h1>遠藤:一言掲示板</h1>
    <form action="bbs.php" method="post">
        <?php if(count($erros)): ?>
        <ul class="erro-list">
            <?php foreach ($errors as $error): ?>
            <li>
                <?php echo htmlspecialchars($error,ENT_QUOTES,'utf-8') ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif ?>
        <P>
            名前:<input type="text" name="name">
            ひとこと:<input type="text" name="comment">
            <input type="submit" name="submit" value="送信する">
        </P>
    </form>
</body>
</html>