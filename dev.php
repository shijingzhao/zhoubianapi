<?php

/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-01-01
 * Time: 20:06
 */

return [
    'SERVER_NAME' => "EasySwoole",
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => EASYSWOOLE_WEB_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER,EASYSWOOLE_REDIS_SERVER
        'SOCK_TYPE' => SWOOLE_TCP,
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'worker_num' => 8,
            'reload_async' => true,
            'max_wait_time' => 3
        ],
        'TASK' => [
            'workerNum' => 4,
            'maxRunningNum' => 128,
            'timeout' => 15
        ]
    ],
    'TEMP_DIR' => null,
    'LOG_DIR' => null,
    'MYSQL'  => [
        'host'          => 'localhost',
        'port'          => 3306,
        'user'          => 'root',
        'password'      => 'mysql_password',
        'database'      => 'tp',
        'timeout'       => 5,
        'charset'       => 'utf8mb4',
    ],
    'JWT' => [
        'iss' => 'jingzhao',    // 发行人
        'aud' => 'jingzhao',    // 用户
        'exp' => 7200,          // 过期时间 默认2小时 2*60*60=7200
        'sub' => 'zhoubian',    // 主题
        'nbf' => '',            // 在此之前不可用
        'key' => 'www.zhoubian.com',    // 签名用的key
    ],
    'WECHAT' => [
        'appid' => 'wx31673a2b7d441090',
        'appsecret' => '377d97623202d66c9332c0502a3845c7'
    ]
];
