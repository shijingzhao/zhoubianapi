<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/11/06 15:27
 * @File Name: List.php
 * @Description:
 */

namespace App\HttpController\Post;

use App\Model\Post\PostModel;
use App\Service\Post\PostService;
use EasySwoole\MysqliPool\Mysql;

class Lists extends \App\HttpController\Base
{
    private $page = 1;
    private $symbol = '';
    private $cursor = 0;

    public function index()
    {
        try {
            $this->page = $this->request()->getRequestParam('page');
            $this->symbol = $this->request()->getRequestParam('type') == 'pull' ?  '>' : '<';
            $this->cursor = $this->request()->getRequestParam('cursor') ?: 0;

            $db = Mysql::defer('mysql');
            // 查询符合条件的帖子
            $postModelObj = new PostModel($db);
            $postList = $postModelObj->getPostList($this->page, $this->symbol, $this->cursor);
            if (empty($postList)) {
                $this->result = $postList;
                throw new \Exception('ok', 0);
            }
            $postServiceObj = new PostService($postModelObj);
            // 帖子的评论
            foreach ($postList as &$post) {
                $post['comment'] = $postServiceObj->getAllComment($post['pId']);
            }
            $this->result = $postList;
        } catch (\Exception $e) {
            $this->code = $e->getCode();
            $this->msg = $e->getMessage();
        }

        $this->writeJson($this->code, $this->result, $this->msg);
    }

    protected function init()
    {
        $validate = new \EasySwoole\Validate\Validate();
        $validate->addColumn('page', 'page')->required('不能为空')->integer('illegal num');
        if ($this->request()->getRequestParam('type')) {
            $validate->addColumn('type', 'type')->inArray(['pull', 'reach'], false, 'illegal type');
            $validate->addColumn('cursor', 'cursor')->integer('illegal num');
        }
        return $validate;
    }
}
