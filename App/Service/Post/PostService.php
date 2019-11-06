<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/11/06 16:25
 * @File Name: Post.php
 * @Description:
 */

namespace App\Service\Post;

class PostService
{
    private $closures;

    public function __construct($closures)
    {
        $this->closures = $closures;
    }
    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-11-06 16:26:52 
     * @Desc: 获取评论服务 
     */
    public function getAllComment(int $pId = 0, array $set = []): array
    {
        if (empty($pId)) return [];
        $subset = $this->closures->getCommentByPId($pId);
        var_dump($subset);
        if (empty($subset)) return [];

        foreach ($subset as &$item) {
            $child = $this->closures->getCommentByPId($item['pId']);
            if (empty($child)) continue;
            $item['comment'][] = $child;
        }
        return $subset;
    }
}
