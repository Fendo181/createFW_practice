<html>
<head>
    <title>
        一言掲示板
    </title>
</head>
<body>
    <h1>遠藤:一言掲示板</h1>
    <form action="bbs_db.php" method="post">
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