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

        $routes = [];

        foreach ($definitions as $url => $params) {
//            eval(\Psy\sh());
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

            $patterns = '/'.implode('/',$tokens);
            $routes[$patterns] = $params;
        }

        return $routes;

    }

    /**
     *
     * PATH_INFOの情報を受け取り、マッチした場合にarray_mergeで$matchesの中身を$paramsにマージして返す
     *
     * @param $path_info
     * @return array|bool
     */
    public function  resolve($path_info)
    {
        if(substr($path_info,0,1) === '/'){
           $path_info = '/'.$path_info;
        }

        foreach ($this->router as $pattern => $params)
        {
            if(preg_match('#^'.$pattern.'$#',$path_info,$matches)){
                $params = array_merge($params,$matches);

                return $params;
            }
        }

        return false;
    }

    /**
     * routerを取得する
     *
     * @return $router
     */
    public function getRouter()
    {
        return $this->router;
    }


}