<?php

namespace App\HttpController;

use \EasySwoole\Http\AbstractInterface\Controller;
use \EasySwoole\Validate\Validate;
use \EasySwoole\Http\Message\Status;

class Base extends Controller
{
    public $code = Status::CODE_OK;
    public $msg  = 'success';
    public $result = [];

    private $notLogin = [
        '/user/login',
        '/seller/login',
        '/post/lists'
    ];

    public function index()
    {
        $this->afterAction('index');
    }

    public function onRequest(?string $action): ?bool
    {
        $res = $this->verifyIdentidy($action);
        if ($res == false) return false;
        $res = $this->validateRule($action);
        if ($res == false) return false;
        return true;
    }

    private function validateRule(?string $action): ?bool
    {
        $ret =  parent::onRequest($action);
        if ($ret === false) return false;

        $vObj = $this->init($action);
        if (empty($vObj)) return true;

        $ret = $this->validate($vObj);
        if ($ret != false) return true;

        $err = $vObj->getError();
        $msg = $err->getFieldAlias() . ' ' . $err->getErrorRuleMsg();
        $this->writeJson(Status::CODE_BAD_REQUEST, [], $msg);
        return false;
    }

    private function verifyIdentidy(?string $action): ?bool
    {
        $path = $this->request()->getUri()->getPath();
        if (in_array($path, $this->notLogin)) return true;

        if (empty($this->request()->getHeader('token')[0])) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], "empty token");
            return false;
        }
        $token = $this->request()->getHeader('token')[0];
        $jwtObj = new \App\Tools\Jwt();
        $decodeData = $jwtObj->decodeToken($token);
        if ($decodeData['status'] != 1) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], "authentication failed");
            return false;
        }
        $this->userInfo = $decodeData['data'];
        return true;
    }

    protected function init()
    { }
}
