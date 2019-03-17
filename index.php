<html>
<head>
    <title>
        サンプルアプリケーション
    </title>
</head>
<body>
    <h1>今の時間帯によって挨拶を変えてくれます</h1>
    <?php $hour = date("Y/m/d H:i:s"); ?>
        <h2>現在時刻は<?= $hour ?> です</h2>
    <?php if( 5 <= $hour && $hour < 10) : ?>
        <p>おはようございます！</p>
    <?php elseif( 11 <= $hour && $hour < 18) : ?>
         <p>こんにちは</p>
    <?php else: ?>
        <p>こんばんわ~!</p>
    <?php endif; ?>
</body>
</html>