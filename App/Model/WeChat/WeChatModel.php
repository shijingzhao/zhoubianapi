<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/16 19:54
 * @File Name: App/Model/WeChat/WeChatModel.php
 * @Description:
 */

namespace App\Model\WeChat;

/**
 * Class WeChatModel
 * Create With Automatic Generator
 */
class WeChatModel extends \App\Model\BaseModel
{
    protected $table = 'wechat';
    protected $primaryKey = 'wx_id';


    /**
     * @getAll
     * @keyword WeChatName
     * @param  int  page  1
     * @param  string  keyword
     * @param  int  pageSize  10
     * @return array[total,list]
     */
    public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10): array
    {
        if (!empty($keyword)) {
            $this->getDbConnection()->where('WeChatAccount', '%' . $keyword . '%', 'like');
        }

        $list = $this->getDbConnection()
            ->withTotalCount()
            ->orderBy($this->primaryKey, 'DESC')
            ->get($this->table, [$pageSize * ($page - 1), $pageSize]);
        $total = $this->getDbConnection()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }


    /**
     * 默认根据主键(we_id)进行搜索
     * @getOne
     * @param  WeChatBean $bean
     * @return WeChatBean
     */
    public function getOne(string $openid): ?WeChatBean
    {
        $info = $this->getDbConnection()
            ->where('openid', $openid)
            ->where('deleted', 0)
            ->getOne($this->table);
        if (empty($info)) {
            return null;
        }
        return new WeChatBean($info);
    }
}
