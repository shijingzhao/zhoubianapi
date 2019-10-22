<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/18 20:51
 * @File Name: App/HttpController/Seller/Login.php
 * @Description:
 */

namespace App\HttpController\Seller;

class Login extends \App\HttpController\Base
{
    private $wechat_token = '';

    public function index()
    {
        $jwtObj = new \App\Tools\Jwt();
        $token = $jwtObj->createToken([
            'class' => __CLASS__,
            'funct' => __FUNCTION__,
            'name'  => 'jingzhao',
            'sex'   => '男'
        ]);

        $this->result['class'] = __CLASS__;
        $this->result['function'] = __FUNCTION__;
        $this->result['token'] = $token;

        $this->writeJson($this->code, $this->result, $this->msg);
    }

    protected function init()
    {
        $validate = new \EasySwoole\Validate\Validate();
        $validate->addColumn('js_code', 'wechat code')->required('不能为空')->length(10, 'illegal length');
        return $validate;
    }
}
