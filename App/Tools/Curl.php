<?php

namespace App\Tools;

use \EasySwoole\Curl\Request;

class Curl
{
    private $url;

    public function __construct($url) 
    {
        $this->url = $url;
    }

    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-10-23 09:47:57 
     * @Desc: 发送curl 
     */
    public function sendCurlRequest() {
        $request = new Request();
        $response = $request->setUrl($this->url)->exec();
        return json_decode($response->getBody(), true);
    }
}