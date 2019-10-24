<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/18 20:51
 * @File Name: App/HttpController/Seller/Login.php
 * @Description:
 */

namespace App\HttpController\User;

use EasySwoole\EasySwoole\Config;
use App\Service\WeChat\WeChatAuth;
use App\Model\User\UserModel;
use App\Model\User\UserBean;
use App\Model\WeChat\WeChatModel;
use EasySwoole\MysqliPool\Mysql;

class Login extends \App\HttpController\Base
{
    private $jsCode;

    public function index()
    {
        try {
            $this->jsCode = $this->request()->getRequestParam('js_code');
            // 获取微信配置
            $weConf = Config::getInstance()->getConf('WECHAT');
            // 实例化微信身份
            $weChatAuthObj = new WeChatAuth($weConf['appid'], $weConf['appsecret']);
            // 登录凭证校验
            $weChatOpenInfo = $weChatAuthObj->code2Session($this->jsCode);

            if (empty($weChatOpenInfo)) {
                throw new \Exception('js_code exp', 500);
            }

            $db = Mysql::defer('mysql');
            // 查询用户ID
            $weChatModelObj = new WeChatModel($db);
            $info = $weChatModelObj->getOne($weChatOpenInfo['openid']);
            if ($info == null) {
                throw new \Exception('no user', 400);
            }
            // 实例化用户映射
            $userBeanObj = new UserBean();
            $userBeanObj->setUId($info->getUId());
            // 获取用户信息
            $userModelObj = new UserModel($db);
            $userInfo = $userModelObj->getOne($userBeanObj);
            if ($userInfo == null) {
                throw new \Exception('no user', 400);
            }

            $jwtObj = new \App\Tools\Jwt();
            $token = $jwtObj->createToken($userInfo);
            $this->result['token'] = $token;
        } catch (\Exception $e) {
            $this->code = $e->getCode();
            $this->msg = $e->getMessage();
        }

        $this->writeJson($this->code, $this->result, $this->msg);
    }

    protected function init()
    {
        $validate = new \EasySwoole\Validate\Validate();
        $validate->addColumn('js_code', 'wechat code')->required('不能为空')->length(32, 'illegal length');
        return $validate;
    }
}
