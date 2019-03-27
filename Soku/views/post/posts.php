<?php

$this->setLayoutVar('title','Hello画面');

?>

<h1>投稿先一覧です</h1>
<div class="posts">
    <?php foreach ($posts as $post ): ?>
        <ul>
            <li>名前:<?= $this->escape($post['name']); ?>(投稿時間:<?= $this->escape($post['created_at']); ?>) </li>
            <li>コメント:<?= $this->escape($post['comment']); ?></li>
        </ul>
    <?php endforeach; ?>
</div>
