<?php

$this->setLayoutVar('title','Hello画面');

?>

<h1>投稿画面です</h1>
<form action="<?php echo $base_url; ?>/post" method="post">
<!--    <input type="hidden" name="_token" value="--><?php //echo $this->escape($_token); ?><!--" />-->

    <!-- エラー処理   -->
    <?php if (isset($errors) && count($errors) > 0): ?>
        <?php echo $this->render('errors', ['errors' => $errors]) ?>
    <?php endif; ?>

    <p>
        名前
        <input type="text" name="name" size="20" maxlength="20">
    </p>
    <p>
        コメント
        <textarea name="comment" rows="2" cols="60"></textarea>
    </p>
    <p><input type="submit" value="投稿する" /></p>
</form>

<h1>投稿先一覧です</h1>
<div class="posts">
    <?php foreach ($posts as $post ): ?>
        <ul>
            <li>名前:<?= $this->escape($post['name']); ?>(投稿時間:<?= $this->escape($post['created_at']); ?>) </li>
            <li>コメント:<?= $this->escape($post['comment']); ?></li>
        </ul>
    <?php endforeach; ?>
</div>
