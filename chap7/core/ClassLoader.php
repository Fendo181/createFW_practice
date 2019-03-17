<?php

class ClassLoader
{
    protected $dir;

    // オートローダークラスを登録する
    public function register()
    {
        spl_autoload_register([$this,'loadClass']);
    }

    // core、modelディレクトリからクラスファイルの読み込みを行う
    public function registerDir($dir)
    {
        $this->dir[ ] = $dir;
    }

    public function getDir()
    {
        return $this->dir;
    }

    //
    public function loadClass($class)
    {
        foreach ($this->dir as $dir){
            $file = $dir . '/' . $class.'php';
            // Tells whether a file exists and is readable
            if(is_readable($file)){
                require $file;

                return;
            }
        }
    }
}