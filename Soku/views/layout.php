<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php if (isset($title)): echo $this->escape($title) . ' - ';
        endif; ?>サンプルアプリケーション
    </title>
</head>
<body>
    <div id="header">
        <h1><a href="<?php echo $base_url; ?>/">>遠藤一言掲示板</a></h1>
    </div>


    <div id="main">
        <?php echo $_content; ?>
    </div>
</body>
</html>
