<?php

class Router
{
    protected $router;

    public function __construct($definitions)
    {
        $this->router = $this->compileRoutes($definitions);
    }

    /**
     *
     *  ルーティング定義配列を受け取り。動的パラメータ指定を正規表現形式に変換する
     *
     * @param $definitions ルーティング定義配列
     */
    public function compileRoutes($definitions)
    {

        $router = [];

        foreach ($definitions as $url => $params) {
            $tokens = explode('/',ltrim($url,'/'));
            foreach ($tokens as $i => $token){
                if(strpos($token,':') === 0){
                    $name = substr($token,1);
                    // 正規表現のキャプチャ機能を使って、key名を指定してキャプチャを取得する
                    // ref:http://php.net/manual/ja/regexp.reference.subpatterns.php
                    // >(?P<name>pattern) という記法を用いて サブパターンに名前をつけることができます
                    $token = '(?P<'.$name.'>[^/]+)';
                }

                $tokens[$i] = $token;
            }

        }

    }
}