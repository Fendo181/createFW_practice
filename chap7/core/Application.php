<?php

/**
 *
 * Class Application
 * アプリケーションの中心となるクラスを
 *
 */
class Application
{
    protected $debug = false;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;

    /**
     * Application constructor.
     * インスタンス生成時にデバッグモードの確認と、初期化を行う
     *
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        $this->setDebugMode($debug);
        $this->initialize();
        $this->configure();
    }

    /**
     *
     * デバッグモードを設定する
     * $debug=trueの時にエラー表示処理を変更する
     *
     * @param $debug
     */
    protected function setDebugMode($debug)
    {
        if($debug){
            $this->debug = true;
            ini_set('display_errors',1);
            error_reporting(-1);
        } else {
            $this->debug = false;
            ini_set('display_errors',0);
        }
    }

    /**
     * 初期化を行う
     */
    public function initialize()
    {
        $this->request = new Request();
        $this->request = new Response();
        $this->request = new Session();
        $this->db_manager = new DbManager();
        $this->router = new Router($this->registerRouter());
    }

    protected function configure()
    {

    }

    abstract public function getRootDir();

    abstract protected function registerRoutes();


    /**
     *
     * デバッグモードの状態を返す
     *
     * @return bool
     */
    public function getDebugMode()
    {
        return $this->debug;
    }

    /**
     *
     * Requestのインスタンスを取得する
     *
     * @return request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     *
     * Responseのインスタンスを取得する
     *
     * @return response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     *
     * Sessionクラスのインスタンスを取得する
     *
     * @return session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     *
     * DbManagerクラスのインスタンスを取得する
     *
     * @return db_manager
     */
    public function getDbManager()
    {
        return $this->db_manager;
    }

    /**
     *
     * Controllerが置かれているディレクトリを取得する
     *
     * @return Controllerファイルが置かれているディレクトリ
     */
    public function getControllerDir()
    {
        return$this->getRootDir(). '/controllers';
    }


    /**
     *
     * Viewが置かれているディレクトリを取得する
     *
     * @return Viewファイルが置かれているディレクトリ
     */
    public function getViewDir()
    {
        return$this->getRootDir(). '/views';
    }

    /**
     *
     * Modelが置かれているディレクトリを取得する
     *
     * @return Modelファイルが置かれているディレクトリ
     */
    public function getModelDir()
    {
        return$this->getRootDir(). '/models';
    }

    /**
     *
     * webファイルが置かれているディレクトリを取得する
     *
     * @return webファイルが置かれているディレクトリ
     */
    public function getWebDir()
    {
        return$this->getRootDir(). '/web';
    }
}