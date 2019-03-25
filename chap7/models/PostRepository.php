<?php


class PostRepository extends DbRepository
{
    public function insert($name, $comment)
    {
        $now = new DateTime();

        $sql = "
            INSERT INTO status(name, comment, created_at)
                VALUES(:name, :cooment, :created_at)
        ";

        $stmt = $this->execute($sql, array(
            ':name'    => $name,
            ':comment'       => $comment,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ));
    }
}
