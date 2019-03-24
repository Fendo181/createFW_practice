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

}