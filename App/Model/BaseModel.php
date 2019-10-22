<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/16 19:36
 * @File Name: App/Model/BaseModel.php
 * @Description:
 */

namespace App\Model;



use EasySwoole\Mysqli\Mysqli;

class BaseModel
{
    protected $db;
    protected $table;

    function __construct(Mysqli $connection)
    {
        $this->db = $connection;
    }

    function getDbConnection(): Mysqli
    {
        return $this->db;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }
}
