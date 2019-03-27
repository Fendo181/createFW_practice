<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php if (isset($title)): echo $this->escape($title) . '-Soku MVC FW';
        endif; ?>
    </title>
</head>
<body>
    <div id="header">
        <h1><a href="<?php echo $base_url; ?>/">Welcome Soku MVC FW!</a></h1>
        <h2>Layoutファイルを使って表示してます</h2>
    </div>

    <a href="<?php echo $base_url; ?>/">ホーム画面</a>
    <a href="<?php echo $base_url; ?>/hello">Hello画面</a>
    <a href="<?php echo $base_url; ?>/posts">投稿先一覧画面</a>

    <div id="main">
        <?php echo $_content; ?>
    </div>
</body>
</html>
