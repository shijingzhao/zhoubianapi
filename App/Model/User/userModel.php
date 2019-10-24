<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/16 19:54
 * @File Name: App/Model/User/UserModel.php
 * @Description:
 */

namespace App\Model\User;

/**
 * Class UserModel
 * Create With Automatic Generator
 */
class UserModel extends \App\Model\BaseModel
{
    protected $table = 'user';
    protected $primaryKey = 'u_id';


    /**
     * @getAll
     * @keyword UserName
     * @param  int  page  1
     * @param  string  keyword
     * @param  int  pageSize  10
     * @return array[total,list]
     */
    public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10): array
    {
        if (!empty($keyword)) {
            $this->getDbConnection()->where('UserAccount', '%' . $keyword . '%', 'like');
        }

        $list = $this->getDbConnection()
            ->withTotalCount()
            ->orderBy($this->primaryKey, 'DESC')
            ->get($this->table, [$pageSize * ($page - 1), $pageSize]);
        $total = $this->getDbConnection()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }


    /**
     * 默认根据主键(UserId)进行搜索
     * @getOne
     * @param  UserBean $bean
     * @return UserBean
     */
    public function getOne(UserBean $bean): ?UserBean
    {
        $info = $this->getDbConnection()
            ->where($this->primaryKey, $bean->getUId())
            ->where('deleted', 0)
            ->getOne($this->table);
        if (empty($info)) {
            return null;
        }
        return new UserBean($info);
    }
}
