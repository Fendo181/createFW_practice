<?php

define('DIR_VENDOR', dirname(__DIR__) .'/vendor/');
require_once(DIR_VENDOR . 'autoload.php');


class PostApplication extends Application
{
    /**
     * @return string アプリケーションファイルのルートディレクトリを返す
     */
    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    /**
     *  DB接続時時の初期設定
     */
    protected function configure()
    {
        $this->dotenv = Dotenv\Dotenv::create(__DIR__);
        $this->dotenv->load();

        $dsn = getenv('DB_DSN');
        $user = getenv('DB_USER');
        $password =getenv('DB_PASS');

        $this->db_manager->connect('master', array(
            'dsn'      => $dsn,
            'user'     => $user,
            'password' => $password,
        ));
    }

    /**
     *
     * ルーティング処理
     *
     * @return array
     */
    protected function registerRoutes()
    {
        return [
            '/'
                => ['controller' => 'post', 'action' => 'home'],
            '/hello'
                => ['controller' => 'post', 'action' => 'hello'],
            '/posts'
                => ['controller' => 'post', 'action' => 'posts'],
        ];
    }

}
