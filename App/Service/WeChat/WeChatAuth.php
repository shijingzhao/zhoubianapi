<?php

/**
 * 微信小程序用户加密数据的解密代码.
 */

namespace App\Service\WeChat;

use App\Tools\Curl;

class WeChatAuth
{
	private $appid;
	private $appsecret;
	private $sessionKey = '/78qhMRkJecRpPH4ok6ZWw==';
	private $accessToken;

	private $paidUnionIdApi = 'https://api.weixin.qq.com/wxa/getpaidunionid?access_token=%s&openid=%s';
	private $accessTokenApi = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
	private $code2SessionApi  = 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';

	private static $OK = 0;
	private static $IllegalAesKey = -41001;
	private static $IllegalIv = -41002;
	private static $IllegalBuffer = -41003;
	private static $DecodeBase64Error = -41004;

	/**
	 * 构造函数
	 * @param $sessionKey string 用户在小程序登录后获取的会话密钥
	 * @param $appid string 小程序的appid
	 */
	public function __construct($appid, $appsecret)
	{
		$this->appid = $appid;
		$this->appsecret = $appsecret;
		$this->accessToken = $this->getAccessToken();
	}

	public function setSessionKey($sessionKey)
	{
		$this->sessionKey = $sessionKey;
	}

	private function sendWeChatReq($requestUrl) {
		$curlObj = new Curl($requestUrl);
		$response = $curlObj->sendCurlRequest();
		if (isset($response['errcode'])) {
			// 加入日志 并 通知开发者
			return [];
		}
		return $response;
	}

	/** 
	 * @Author: shi jingzhao 
	 * @Date: 2019-10-23 14:43:59 
	 * @Desc: 获取小程序全局唯一后台接口调用凭据 
	 */
	public function getAccessToken()
	{
		$requestUrl = sprintf($this->accessTokenApi, $this->appid, $this->appsecret);
		$response = $this->sendWeChatReq($requestUrl);
		if (empty($response)) return '';
		return $response['access_token'];
	}

	/** 
	 * @Author: shi jingzhao 
	 * @Date: 2019-10-23 14:54:36 
	 * @Desc: 登录凭证校验 
	 */
	public function code2Session($jsCode) {
		$requestUrl = sprintf($this->code2SessionApi, $this->appid, $this->appsecret, $jsCode);
		$response = $this->sendWeChatReq($requestUrl);
		if (empty($response)) return [];
		return $response;
	}

	/** 
	 * @Author: shi jingzhao 
	 * @Date: 2019-10-23 16:22:50 
	 * @Desc: 获取该用户的 UnionId 
	 */	
	public function getPaidUnionId($openid) {
		$requestUrl = sprintf($this->paidUnionIdApi, $this->accessToken, $openid);
		$response = $this->sendWeChatReq($requestUrl);
		if (empty($response)) return [];
		return $response;
	}


	/**
	 * 检验数据的真实性，并且获取解密后的明文.
	 * @param $encryptedData string 加密的用户数据
	 * @param $iv string 与用户数据一同返回的初始向量
	 *
	 * @return int 成功0，失败返回对应的错误码
	 */
	public function decryptData($encryptedData, $iv)
	{
		if (strlen($this->sessionKey) != 24) {
			return [self::$IllegalAesKey, []];
		}
		$aesKey = base64_decode($this->sessionKey);


		if (strlen($iv) != 24) {
			return [self::$IllegalIv, []];
		}
		$aesIV = base64_decode($iv);

		$aesCipher = base64_decode($encryptedData);

		$result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

		$dataObj = json_decode($result);
		if ($dataObj  == NULL) {
			return [self::$IllegalBuffer, []];
		}
		if ($dataObj->watermark->appid != $this->appid) {
			return [self::$IllegalBuffer, []];
		}
		return [self::$OK, $dataObj];
	}
}
