<?php


class PostRepository extends DbRepository
{
    /*
     * 投稿を全て取得する
     */
    public function fetchAllPosts()
    {
        $sql = "
         SELECT * FROM post;   
        ";
        return $this->fetchAll($sql);
    }

    /**
     *
     * 新規投稿を行う
     *
     * @param $name
     * @param $comment
     */
    public function insert($name, $comment)
    {
        $now = new DateTime();

        $sql = "
            INSERT INTO post(name, comment, created_at)
                VALUES(:name, :comment, :created_at)
        ";

        $stmt = $this->execute($sql, [
            ':name'    => $name,
            ':comment'       => $comment,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ]);
    }
}
