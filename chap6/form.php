<html>
<head>
    <title>
        フォーム画面
    </title>
</head>
<body>
    <?php if( isset($_GET['name']) && strlen($_GET['name'])>0):  ?>
    <p>
        <?php
            echo htmlspecialchars($_GET['name'],ENT_QUOTES,'utf-8');
        ?>
        さん、こんにちは！
    </p>
    <?php endif; ?>
    <form action="form.php" method="get">
        <p>
            名前を入力して下さい
            <input type="text" name="name">
        </p>
        <p>
            <input type="submit" value="送信">
        </p>
    </form>
</body>
</html>