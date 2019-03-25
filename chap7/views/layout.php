<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if (isset($title)): echo $this->escape($title) . ' - ';
        endif; ?>BBS</title>

    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
</head>
<body>
<div id="header">
    <h1><a href="<?php echo $base_url; ?>/">遠藤 掲示板へようこそ！</a></h1>
</div>

<div id="main">
    <?php echo $_content; ?>
</div>
</body>
</html>
