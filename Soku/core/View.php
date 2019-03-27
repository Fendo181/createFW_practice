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
     * 変数layout.phpに$nameをキーとした$valueを値としいて格納する
     *
     * @param $name
     * @param $value
     */
    public function setLayoutVar($name,$value)
    {
        $this->layout_variables[$name] = $value;
    }

    /**
     * ビューファイルをレンダリング
     *
     * @param string $_path viewファイルのパス
     * @param array $_variables 表示する値
     * @param mixed $_layout
     * @return string
     */
    public function viewRender($_path, $_variables = [ ], $_layout = false)
    {
        $_file = $this->base_dir . '/' . $_path . '.php';

        extract(array_merge($this->defaults, $_variables));

        // アウトプットバッファリグ開始
        ob_start();
        // バッファを超えた場合に自動でフラッシュする設定をOFFにする
        ob_implicit_flush(0);

        // viewファイル読み込む
        require $_file;

        // $contentに
        $content = ob_get_clean();

        if ($_layout) {
            $content = $this->viewRender($_layout,
                array_merge($this->layout_variables, array(
                        '_content' => $content,
                    )
                ));
        }

        return $content;
    }

    public function escape($string)
    {
        return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
    }



}