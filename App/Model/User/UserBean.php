<?php
/**
 * @Author: jingzhao
 * @Created Time : 2019/10/16 19:37
 * @File Name: App/Model/User/UserBean.php
 * @Description:
 */
namespace App\Model\User;

class UserBean extends \EasySwoole\Spl\SplBean
{
	protected $u_id;
	protected $nickname;
	protected $sex;
	protected $birthday;
	protected $avatar;
	protected $city;
	protected $u_type;
	protected $u_status;
	protected $created;
	protected $updated;
	protected $deleted;


	public function setUId($u_id)
	{
		$this->u_id = $u_id;
	}
	public function getUId()
	{
		return $this->u_id;
	}

	public function setNickName($nickname)
    {
        $this->nickname = $nickname;
    }
    public function getNickName()
    {
        return $this->nickname;
	}

	public function setSex($sex)
    {
        $this->sex = $sex;
    }
    public function getSex()
    {
        return $this->sex;
	}

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    public function getAvatar()
    {
        return $this->avatar;
	}

	public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
    public function getBirthday()
    {
        return $this->birthday;
	}

	public function setCity($city)
    {
        $this->city = $city;
    }
    public function getCity()
    {
        return $this->sex;
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
