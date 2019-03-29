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
    protected $auth_actions = [];

    public function __construct($application)
    {
        // Ccontrollerが10文字なので、後ろの10文字を取り除いて、クラス名を小文字にする
        $this->controller_name = strtolower(substr(get_class($this), 0, -10));

        $this->application = $application;
        $this->request = $application->getRequest();
        $this->response = $application->getResponse();
        $this->session = $application->getSession();
        $this->db_manager = $application->getDbManager();
    }


    /**
     *
     * Applicationクラスから呼び出されて実際に実行するメソッド
     *
     * @param $action
     * @param array $params
     * @return mixed
     */
    public function run($action, $params = [])
    {
        $this->action_name = $action;

        $action_methods = $action . 'Action';

        if (!(method_exists($this, $action_methods))) {
            $this->forward404();
        }

        //ログイン判定処理
        if($this->needsAuthentication($action) && !$this->session->isAuthenticated()){
            throw new UnauthorizedActionException();
        }

        // 可変関数で動的にメソッドを変えるようにする
        $content = $this->$action_methods($params);

        return $content;
    }

    /**
     *
     * ログインが必要か判定を行う
     *
     * @param $action
     * @return bool|void
     */
    public function needsAuthentication($action)
    {
        if($this->auth_actions === true || (is_array($this->auth_actions) && in_array($action, $this->auth_actions))){
          return true;
        }

        return false;
    }



    /**
     *
     *  ビューファイルの読み込み処理をラッピングしたメソッド
     *
     * @param array $variables
     * @param null $template
     * @param string $layout
     * @return string
     */
    protected function render($variables = [], $template = null, $layout = 'layout')
    {
        $defaults = [
            'request' => $this->request,
            'base_url' => $this->request->getbaseURl(),
            'sesssion' => $this->session,

        ];

        // Viewのインスタンスを生成する
        $view = new View($this->application->getViewDir(), $defaults);

        // テンプレート名を指定してなかったら、アクション名がテンプレート名になる
        if (is_null($template)) {
            $template = $this->action_name;
        }

        // UseControllerだったら、user/$templateとなる
        $path = $this->controller_name . '/' . $template;

        // Viewクラスのrenderメソッド
        return $view->renderView($path, $variables, $layout);
    }

    /**
     *
     * 404画面に遷移させるメソッド
     *
     * @throws HttpNotFoundException
     */
    protected function forward404()
    {
        throw new HttpNotFoundException('Forwarded 404 page from' . $this->controller_name . '/' . $this->action_name);
    }

    /**
     *
     * URLを引数として受け取り、Responseオブジェクトにリダイレクトさせるように設定する
     *
     * @param $url
     */
    protected function redirect($url)
    {
        if (!preg_match('#https?://#', $url)) {
            $protocol = $this->request->isSSl() ? 'https//' : 'http';
            $host = $this->request->getHost();
            $base_url = $this->request->getBaseUrl();

            $url = $protocol . $host . $url;
        }

        $this->response->setStatusCode(302, 'Found');
        // リダイレクトする
        $this->response->setHttpHeader('Location', $url);
    }

    // CSRF対策

    /**
     *
     * CSRF対策の為、トークンを生成し、サーバ上に保存するためにセッションに格納を行う
     *
     * @param $form_name
     * @return csrf_tpken
     */
    protected function generateCsrfToken($form_name)
    {
        $key = 'csrf_tokens/' . $form_name;
        $tokens = $this->session->get($key, []);
        if (count($tokens) > 10) {
            array_shift($tokens);
        }

        $token = sha1($form_name . session_id() . microtime());
        $tokens[] = $token;

        $this->session->set($key, $tokens);

        return $token;
    }

    /**
     *
     * セッション上に格納されたCSRFトークンを確認し一度破棄してから再度生成します
     *
     * @param $form_name
     * @param $token
     * @return bool
     */
    protected function checkCsrfTokens($form_name, $token)
    {
        $key = 'csrf_tokens/' . $form_name;
        $tokens = $this->session->get($key,[]);

        $pos = array_search($token, $tokens, true);

        if($pos !== false){
            unset($tokens[$pos]);
            $this->session->set($key,$tokens);

            return true;
        }

        return false;
    }
}