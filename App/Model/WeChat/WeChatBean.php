<?php

/**
 * @Author: jingzhao
 * @Created Time : 2019/10/16 19:37
 * @File Name: App/Model/WeChat/WeChatBean.php
 * @Description:
 */

namespace App\Model\WeChat;

class WeChatBean extends \EasySwoole\Spl\SplBean
{
    protected $wx_id;
    protected $openid;
    protected $unionid;
    protected $u_id;
    protected $s_id;
    protected $wx_type;
    protected $wx_status;
    protected $created;
    protected $updated;
    protected $deleted;

    public function setWeChatId($wx_id)
    {
        $this->wx_id = $wx_id;
    }
    public function getWeChatId()
    {
        return $this->wx_id;
    }

    public function setOpenId($openid)
    {
        $this->openid = $openid;
    }
    public function getOpenId()
    {
        return $this->openid;
    }

    public function setUnionId($unionid)
    {
        $this->unionid = $unionid;
    }
    public function getUnionId()
    {
        return $this->wx_id;
    }

    public function setUId($u_id)
    {
        $this->u_id = $u_id;
    }
    public function getUId()
    {
        return $this->u_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }
    public function getSId()
    {
        return $this->s_id;
    }

    public function setNickName($nickname)
    {
        $this->nickname = $nickname;
    }
    public function getNickName()
    {
        return $this->nickname;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setType($wx_type)
    {
        $this->wx_type = $wx_type;
    }
    public function getTyep()
    {
        return $this->wx_type;
    }

    public function setStatus($wx_status)
    {
        $this->wx_status = $wx_status;
    }
    public function getStatus()
    {
        return $this->wx_status;
    }

    public function setCreate($created)
    {
        $this->created = $created;
    }
    public function getCreate()
    {
        return $this->created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
    public function getUpdated()
    {
        return $this->updated;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }
}
