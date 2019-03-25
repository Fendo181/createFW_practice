<?php
/**
 * Created by PhpStorm.
 * User: endu
 * Date: 2019/03/25
 * Time: 14:56
 */

class View
{
    protected $base_dir;
    protected $defaults;
    protected $layout_variables = [];

    /**
     *
     * View constructor.
     *
     * @param $base_dir vireファイルが置かれておりディレクトリ
     * @param $defaults Viewに渡すdefaultの値を設定できる
     */
    public function __construct($base_dir, $defaults)
    {
        $this->base_dir = $base_dir;
        $this->defaults = $defaults;
    }

    /**
     *
     * 変数layout_variablesに$nameをキーとした$valueを値としいて格納する
     *
     * @param $name
     * @param $value
     */
    public function setLayoutVar($name,$value)
    {
        $this->layout_variables[$name] = $value;
    }

    /**
     *
     *  ビューファイルの読み込みを行う
     *
     * @param $_path
     * @param array $_variables
     * @param bool $_layout
     * @return string
     */
    public function render($_path, $_variables =[], $_layout = false)
    {
        $_file = $this->base_dir . '/'.$_path.'php';

        extract(array_merge($_path,$_variables));

        // アウトプットバッファリング
        ob_start();
        // 自動フラッシュを無効化する
        ob_implicit_flush(0);

        require $_file;

        $content = ob_get_clean();

        if($_layout){
            $content = $this->render($_layout,
                array_merge($this->layout_variables,
                    [
                        '_content' => $content,
                    ]
                ));
        }

        return $content;
    }

    public function escape($string)
    {
        return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
    }



}