<?php

class Session
{
    protected static $sessionStarted = false;
    protected static $sessionIdRegenerated = false;

    /**
     *
     * セッションが無かったら再度セッションを開始する
     *
     */
    public function __construct()
    {
        if(!self::$sessionStarted){
            session_start();

            self::$sessionStarted = true;
        }
    }

    /**
     *
     * セッションに$nameをkeyとして$valueを格納する
     *
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     *
     * $nameをkeyとするセッションIDを取得する。なければ、nullを返す
     *
     * @param $name
     * @param null $default
     * @return  $_SESSION[$name] | null
     */

    public function get($name,$default = null)
    {
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }

        return $default;
    }

    /**
     *
     * $nameをkeyにもつセッションIDを削除する
     *
     * @param $name
     */
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }


    /**
     *
     * セッションに含まれているセッションを空にする
     *
     */
    public function clear()
    {
        $_SESSION = [ ];
    }

    /**
     *
     * セッションIDを新しく発行する
     *
     * @param bool $destory
     */
    public function regenerate($destory = true)
    {
        if(!self::$sessionIdRegenerated){
            session_regenerate_id($destory);

            self::$sessionIdRegenerated = true;
        }
    }

    /**
     *
     * 認証する際に、_authenticatedをkeyとしてセッションID格納して、セッションIDを新しく発行する
     *
     * @param $bool
     */
    public function setAuthenticate($bool)
    {
        $this->set('_authenticated',(bool)$bool);

        $this->regenerate();
    }

    /**
     *
     * ユーザがログインしているか判定を行う
     *
     */
    public function isAuthenticated()
    {
        return $this->get('__authenticated',false);
    }


}