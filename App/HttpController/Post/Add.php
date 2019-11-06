<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/11/06 16:37
 * @File Name: Add.php
 * @Description:
 */

namespace App\HttpController\Post;


use App\Model\Post\PostModel;
use EasySwoole\MysqliPool\Mysql;

class Add extends \App\HttpController\Base
{
    private $uId = 0;
    private $pPId = 0;
    private $content = '';
    private $images = [];

    public function index()
    {
        try {
            // $this->uId = $this->userInfo['uId'];
            $this->uId = 1;
            $this->content = $this->request()->getRequestParam('content');
            $this->images = $this->request()->getRequestParam('images');
            $this->pPId = $this->request()->getRequestParam('pPId');

            $db = Mysql::defer('mysql');
            // 创建帖子
            $postModelObj = new PostModel($db);
            $pId = $postModelObj->createdPost($this->uId, $this->content, $this->pPId);
            if (!$pId) {
                throw new \Exception('发布失败', 1);
            }

            if (!empty($this->images)) {
                // 创建图像
            }
        } catch (\Exception $e) {
            $this->code = $e->getCode();
            $this->msg = $e->getMessage();
        }

        $this->writeJson($this->code, $this->result, $this->msg);
    }
    protected function init()
    { }
}
