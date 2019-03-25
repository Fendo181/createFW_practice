<?php
define('DIR_VENDOR', dirname(__DIR__) .'/vendor/');
require_once(DIR_VENDOR . 'autoload.php');

class BbsApplication extends Application
{
    protected $login_action = ['account', 'signin'];
    protected $dotenv;

    public function getRootDir()
    {
       return dirname(__FILE__);
    }

    public function registerRoutes()
    {
        return [];
    }

    protected function configure()
    {
        $this->dotenv = Dotenv\Dotenv::create(__DIR__);
        $this->dotenv->load();

        $dsn = getenv('DB_DSN');
        $user = getenv('DB_USER');
        $password =getenv('DB_PASS');

       $this->db_manager->connect('master',[
            'dsn' => $dsn,
            'user' => $user,
            'password' => $password
           ]
       );

    }
}