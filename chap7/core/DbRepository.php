<?php

abstract class DbRepository
{
    protected $con;

    public function __construct($con)
    {
        $this->setConnection($con);
    }

    /**
     *
     * DBへの接続情報を$con変数に格納する
     *
     * @param $con
     */
    public function setConnection($con)
    {
        $this->con = $con;
    }

    /**
     *
     * プリペアドステートメントを使ってSQLを実行する
     * ref:https://www.php.net/manual/ja/pdo.prepared-statements.php
     *
     * @param $sql
     * @param array $params
     * @return PDOStatementクラスのインスタンス
     */
    public function execute($sql,$params = [])
    {
        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     *
     * 1行だけを返す
     *
     * @param $sql
     * @param array $params
     * @return PDOStatementクラスのfecthメソッドの実行結果
     */
    public function fetch($sql,$params = [])
    {
        return $this->execute($sql,$params)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * 全ての行を返す
     *
     * @param $sql
     * @param array $params
     * @return  PDOStatementクラスののfecthAllメソッドの実行結果
     */
    public function fetchAll($sql,$params = [])
    {
        return $this->execute($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    }
}