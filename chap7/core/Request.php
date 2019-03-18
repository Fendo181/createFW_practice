<?php

/**
 * Class Request
 */
class Request
{

    /**
     *
     * POSTメソッドでリクエストが来たのか判定する
     *
     * @return bool
     */
    public function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }

        return false;
    }

    /**
     *
     * $_GETでリクエストがあった際のパラメータを取得して返す
     * なければnullを返す
     *
     * @param $name
     * @param null $default
     * @return $_GET[$name] | $default
     */
    public function getGet($name, $default= null)
    {
        if(isset($_GET[$name])){
            return $_GET[$name];
        }

        return $default;
    }


    /**
     *
     * サーバのホスト名を取得する
     * リクエストヘッダに無い場合はApache側に格納されている $_SERVER['SERVER_NAME']を返します
     *
     * @return $_SERVER['HTTP_HOST'] | $_SERVER['SERVER_NAME']
     */
    public function getHost(){
        if(!empty($_SERVER['HTTP_HOST'])){
            return $_SERVER['HTTP_HOST'];
        }

        return $_SERVER['SERVER_NAME'];
    }

    /**
     *
     * HTTPSでアクセスされたか判定を行う
     *
     * @return bool
     */
    public function isSsl()
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTP'] === 'on'){
            return true;
        }

        return false;
    }

    /**
     * @return $_SERVER['REQUEST_URI']
     */
    public function  getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

}

