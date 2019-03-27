<?php

class DbManager
{
    protected $connections = [];
    protected $repository_connection_map = [];
    protected $repositories = [];

    /**
     *
     * PDOオブジェクトを使ってDBへの接続情報を管理する
     *
     * @param $name
     * @param $params
     */
    public function connect($name,$params)
    {
        $params = array_merge([
           'dsn' => null,
           'user' => '',
           'password' => '',
           'options' => [],
        ],$params);

        try {
            $con = new PDO(
                $params['dsn'],
                $params['user'],
                $params['password'],
                $params['options']
            );
        }catch (PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
        }


        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $this->connections[$name] = $con;
    }

    /**
     *
     * 指定がなければ最初のPDOクラスのインスタンスを返して、$nameがあれば新しいPDOインスタンスを返します
     *
     * @param null $name
     * @return PDOインスタンス
     */
    public function getConnection($name = null)
    {
        if(is_null($name)){
            return current($this->connections);
        }

        return $this->connections[$name];
    }

    /**
     *
     * Repositoryクラスでどの接続を扱うかを管理する
     * repository_connection_mapプロパティにテーブルごとのRepositoryクラスと接続名の対応を格納する
     *
     * @param $repository_name
     * @param $name
     */
    public function setRepositoryConnectionMap($repository_name, $name)
    {
        $this->repository_connection_map[$repository_name] = $name;
    }

    /**
     *
     * Repositoryクラスに対応する接続を取得しようとした際に、既にrepository_connection_mapに設定されていたら、その設定を使う
     * そうでなければ、最初に作成したものを取得する
     *
     * @param $repository_name
     * @return PDOインスタンス
     */
    public function getConnectionForRepository($repository_name)
    {
        if(isset($this->repository_connection_map[$repository_name])){
            $name = $this->repository_connection_map[$repository_name];
            $con = $this->getConnection($name);
        }else{
            $con = $this->getConnection();
        }

        return $con;
    }

    /**
     *
     * 一度作成したRepositoryクラスのインスタンスを取得する
     *
     * @param $repository_name
     * @return Repositoryクラスのインスタンスを返す
     */
    public function get($repository_name)
    {
        if(!isset($this->repositories[$repository_name])){
            $repository_class = $repository_name.'Repository';
            $con = $this->getConnectionForRepository($repository_name);

            $repository = new $repository_class($con);

            $this->repositories[$repository_name] = $repository;
        }

        return $this->repositories[$repository_name];
    }

    /**
     *
     * インスタンスが破棄されたタイミングでデータベースの接続状態を解除する
     *
     */
    public function __destruct()
    {
        foreach ($this->repositories as $repository){
            unset($repository);
        }

        foreach ($this->connections as $con){
            unset($con);
        }
    }
}