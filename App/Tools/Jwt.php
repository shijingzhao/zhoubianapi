<?php

/** 
 * @Author: shi jingzhao 
 * @Date: 2019-10-18 15:28:29 
 * @Desc: JWT token 
 */

namespace App\Tools;

use \EasySwoole\EasySwoole\Config;
use \EasySwoole\Jwt\Jwt as EasySwooleJwt;

class Jwt
{
    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-10-18 16:20:39 
     * @Desc: 生成token 
     */
    public function createToken($data = [])
    {
        $iat = time();
        $jwtConf = Config::getInstance()->getConf('JWT');
        $jwtObj = EasySwooleJwt::getInstance()->algMethod('AES')->setSecretKey($jwtConf['key'])->publish();

        ### 设置Payload ###
        $jwtObj->setIat($iat);
        $jwtObj->setAud($jwtConf['aud']);
        $jwtObj->setIss($jwtConf['iss']);
        $jwtObj->setSub($jwtConf['sub']);

        $jwtObj->setData($data);

        $token = $jwtObj->__toString();
        return $token;
    }

    /** 
     * @Author: shi jingzhao 
     * @Date: 2019-10-18 17:03:13 
     * @Desc: 解密token 
     */
    public function decodeToken($token)
    {
        if (empty($token)) return [];

        $jwt =  EasySwooleJwt::getInstance();
        try {
            $result = $jwt->decode($token);
            var_dump($result);
            switch ($result->getStatus()) {
                case  1:
                    $status = 1;
                    break;
                case  2:
                    $status = 0;
                    echo '验证失败';
                    break;
                case  3:
                    $status = 2;
                    echo 'token过期';
                    break;

                default:
                    $status = 0;
                    echo 'error';
                    break;
            }

            return ['status' => $status, 'data' => $result->getData()];
        } catch (\Exception $e) { }
    }
}
