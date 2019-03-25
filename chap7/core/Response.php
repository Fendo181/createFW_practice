<?php

class Response
{

    protected $content;
    protected $status_code = 200;
    protected $status_text = 'OK';
    protected $http_headers = [];


    /**
     *
     * 各プロパティに設定された値を元にレスポンスの送信を行う
     *
     */
    public function send()
    {
        header('HTTP/1.1' . $this->status_code. ''.$this->status_text);

        foreach ($this->http_headers as $name => $value){
            header($name.':'.$value);
        }

        echo $this->content;
    }

    /**
     *
     * contentをセットする
     *
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     *
     * status_codeとstatus_textをセットする
     *
     * @param $status_code
     * @param $status_text
     */
    public function setStatusCode($status_code,$status_text)
    {
        $this->status_code = $status_code;
        $this->status_text = $status_text;

    }

    /**
     *
     * http_headersをセットする
     *
     * @param $name
     * @param $value
     */
    public function setHttpHeader($name, $value)
    {
        $this->http_headers[$name] = $value;
    }
}