<?php
/**
 * Created by PhpStorm.
 * User: wenwu
 * Date: 2018/9/2
 * Time: 23:02
 */
return [
    [
        'name'   => '本地 redis', // Optional name.
        'host'   => '127.0.0.1',
        'port'   => 6379,
        'filter' => '*',
        'scheme' => 'tcp', // Optional. Connection scheme. 'tcp' - for TCP connection, 'unix' - for connection by unix domain socket
        'path'   => '', // Optional. Path to unix domain socket. Uses only if 'scheme' => 'unix'. Example: '/var/run/redis/redis.sock'
        'scansize'=>1000,
        // Optional Redis authentication.
        //'auth' => 'redispasswordhere' // Warning: The password is sent in plain-text to the Redis server.
    ],
    [
        'name'   => '可以配置多个', // Optional name.
        'host'   => '127.0.0.1',
        'port'   => 6379,
        'filter' => '*',
        'scheme' => 'tcp', // Optional. Connection scheme. 'tcp' - for TCP connection, 'unix' - for connection by unix domain socket
        'path'   => '', // Optional. Path to unix domain socket. Uses only if 'scheme' => 'unix'. Example: '/var/run/redis/redis.sock'
        'scansize'=>1000,
        // Optional Redis authentication.
        //'auth' => 'redispasswordhere' // Warning: The password is sent in plain-text to the Redis server.
    ]
];