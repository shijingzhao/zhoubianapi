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
    protected $wxId;
    protected $openid;
    protected $unionid;
    protected $uId;
    protected $sId;
    protected $wxType;
    protected $wxStatus;
    protected $created;
    protected $updated;
    protected $deleted;

    public function setWeChatId($wxId)
    {
        $this->wxId = $wxId;
    }
    public function getWeChatId()
    {
        return $this->wxId;
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
        return $this->wxId;
    }

    public function setUId($uId)
    {
        $this->uId = $uId;
    }
    public function getUId()
    {
        return $this->uId;
    }

    public function setSId($sId)
    {
        $this->sId = $sId;
    }
    public function getSId()
    {
        return $this->sId;
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

    public function setType($wxType)
    {
        $this->wxType = $wxType;
    }
    public function getTyep()
    {
        return $this->wxType;
    }

    public function setStatus($wxStatus)
    {
        $this->wxStatus = $wxStatus;
    }
    public function getStatus()
    {
        return $this->wxStatus;
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
