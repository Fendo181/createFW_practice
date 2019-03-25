<?php

abstract class Controller
{
    protected $controller_name;
    protected $action_name;
    protected $application;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;

    public function __construct($application)
    {
        // Ccontrollerが10文字なので、後ろの10文字を取り除いて、クラス名を小文字にする
        $this->controller_name = strtolower(substr(get_class($this),0,-10));

        $this->application = $application;
        $this->request = $application->getRequest();
        $this->response = $application->getResponse();
        $this->session = $application->getSession();
        $this->db_manager = $application->getDbManager();
    }


    public function run($action, $params = [])
    {
        $this->action_name = $action;

        $action_methods = $action.'Action';

        if(!(method_exists($this,$action_methods))){
            $this->forward404();
        }

        // 可変関数で動的にメソッドを変えるようにする
        $content = $this->$action_methods($params);

        return $content;
    }

    /**
     *
     *  ビューファイルの読み込み処理をラッピングしたメソッド
     *
     *
     * @param array $variables
     * @param null $template
     * @param string $layout
     * @return string
     */
    protected function rendar($variables = [], $template = null, $layout = 'layout')
    {
        $defaults = [
            'request' => $this->request,
            'base_url' => $this->request->baseURl(),
            'sesssion' => $this->session,

        ];

        // Viewのインスタンスを生成する
        $view = new  View($this->application->getViewDir(),$defaults);

        if(is_null($template)){
            $template = $this->action_name;
        }

        // UseControllerだったら、user/$templateとなる
        $path = $this->controller_name . '/' . $template;

        return $view->render($path,$variables,$layout);
    }



}