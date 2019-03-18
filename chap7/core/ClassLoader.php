<?php

class ClassLoader
{
    protected $dir;

    /**
     *
     * PHPにオートローダクラスを指定する
     *
     */
    public function register()
    {
        spl_autoload_register([$this,'loadClass']);
    }

    /**
     *
     * 特定のディレクトリからクラスを読むこむようにします。
     *
     * @param $dir ディレクトリ名
     */
    public function registerDir($dir)
    {
        $this->dir[ ] = $dir;
    }

    /**
     *
     * $dirを取得する
     *
     * @return $dir
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     *
     * クラスが指定したディレクトリに存在し、存在すればそのクラスをrequireしてくる
     *
     * @param $class クラス名
     */
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