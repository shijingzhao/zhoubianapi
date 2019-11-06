<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/11/06 15:46
 * @File Name: PostModel.php
 * @Description:
 */

namespace App\Model\Post;

class PostModel extends \App\Model\BaseModel
{
    protected $table = 'post';
    protected $primaryKey = 'pId';

    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-11-06 16:54:00 
     * @Desc: 创建新帖子 
     */
    public function createdPost(int $uId = 0, string $content = '', int $pPId = 0): int
    {
        var_dump(['uId' => $uId, 'content' => $content]);
        $pId = $this->getDbConnection()->insert($this->table, ['uId' => $uId, 'content' => $content, 'pPId' => $pPId]);
        return $pId;
    }
    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-11-06 15:47:13 
     * @Desc: 首页列表 
     */
    public function getPostList(int $page = 1, string $symbol = '', int $cursor = 0, int $pageSize = 10): array
    {
        if ($page > 1) {
            $list = $this->getDbConnection()
                ->where('pId', $cursor, $symbol);
        }

        $fields = ['pId', 'uId', 'uName', 'created', 'content', 'imgs'];
        $list = $this->getDbConnection()
            ->where('pType', 1)
            ->orderBy($this->primaryKey, 'DESC')
            ->get($this->table, [$pageSize * ($page - 1), $pageSize], $fields);
        return $list ?: [];
    }

    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-11-06 16:09:21 
     * @Desc: 获取评论 
     */
    public function getCommentByPId(int $pId = 0): array
    {
        if ($pId < 1) return [];

        $fields = ['pId', 'uId', 'uName', 'created', 'content'];
        $commentList = $this->getDbConnection()
            ->where('pPId', $pId)
            ->orderBy($this->primaryKey, 'ASC')
            ->get($this->table);
        return $commentList ?: [];
    }
}
