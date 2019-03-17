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
    // クエリーを実行時にエラーを表示する為
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo  '接続できました!';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$errors = [];

// POSTなら保存処理を行う
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 名前が正しく入力されているかチェック
    $name = null;

    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力して下さい';
    } else if (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前を40文字以内で入力して下さい';
    } else {
        $name = $_POST['name'];
    }

    // 一言が正しく入力されているかチェックする
    $comment = null;

    if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $errors['comment'] = 'コメントを';
    } else if (strlen($_POST['name']) > 200) {
        $errors['comment'] = 'ひとことは200文字以内で入力して下さい';
    } else {
        $comment = $_POST['comment'];
    }

    //エラーがなければ保存する
    if (count($errors) === 0) {
        $stmt = $pdo->prepare('INSERT INTO post (name, comment, created_at) values (:name,:comment,:created_at)');
        $stmt->bindValue(':name',$name);
        $stmt->bindValue(':comment',$comment);
        $stmt->bindValue(':created_at',date('Y-m-d H:i:s'));

        try {
            $res = $stmt->execute();
        }catch (PDOException $e) {
            echo 'クエリーの実行に失敗しました' . $e->getMessage();
        }

    }else{
        echo 'DB保存中にエラーがおきました!';
        print_r($errors);
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
        <?php if(count($errors)): ?>
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
    <!-- 投稿された一言の表示   -->
    <?php

    $sql = " SELECT * FROM `post` ORDER BY `created_at` DESC" ;
    $result = $pdo->query($sql);
    $posts = $result->fetchAll();

    ?>
    <?php if($result !== false) : ?>
      <ul>
          <?php foreach ($posts as $post) : ?>
            <li>
                <p>
                    名前:<?php echo htmlspecialchars($post['name'],ENT_QUOTES,'UTF-8')?> (<?php echo htmlspecialchars($post['created_at'],ENT_QUOTES,'UTF-8')?>)
                </p>
                <p>
                    コメント:<?php echo htmlspecialchars($post['comment'],ENT_QUOTES,'UTF-8')?>
                </p>
            </li>
          <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php
    //取得結果を表示して接続を閉じる
    $pdo = null;

    //投稿後にページをリダイレクトする
    header('Location http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    ?>
</body>
</html>