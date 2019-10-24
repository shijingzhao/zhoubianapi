<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/23 20:45
 * @File Name: App/HttpController/User/Info.php
 * @Description:
 */

namespace App\HttpController\User;

class Info extends \App\HttpController\Base
{
    public function index()
    {
        $this->result['info'] = $this->userInfo;
        $this->writeJson($this->code, $this->result, $this->msg);
    }

    protected function init()
    { }

    private function func()
    {
        
        while (!doomsDay) {
            if (today() == 0x400) {
                celebrate('Programmer`s Day');
            }
        }

        while (!doomsDay) 
        {
            if (today() == 0x400) {
                celebrate('Programmer`s Day');
            }
        }
    }
}
