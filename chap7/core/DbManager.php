<?php

class DbManager
{
    protected $connections = [];

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

        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']
        );

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
            return current($this->connections[$name]);
        }

        return $this->connections[$name];
    }

}