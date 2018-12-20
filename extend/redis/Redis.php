<?php
/**
 * Created by PhpStorm.
 * User: wenwu
 * Date: 2018/9/4
 * Time: 21:43
 */
namespace Redis;
use Predis\Client;

class Redis{
    private static $redis=null;
    private static $server;
    private function __construct($server=[]){
        if(count($server)==0) {
            $select = session('redisServerAndDb');
            $serverIndex = isset($select['server']) ? $select['server'] : 0;
            $dbIndex = isset($select['db']) ? $select['db'] : 0;
            if ($dbIndex > 16) $dbIndex = 0;
            $config = config('redis.');
            $server = isset($config[$serverIndex]) ? $config[$serverIndex] : $config[0];
            $server['db'] = $dbIndex;
        }
        if(isset($server['scheme']) && $server['scheme'] === 'unix' && $server['path']) {
            $redis = new Client(array('scheme' => 'unix', 'path' => $server['path']));
        } else {
            $redis = !$server['port'] ? new Client($server['host']) : new Client('tcp://'.$server['host'].':'.$server['port']);
        }

        try {
            $redis->connect();
        } catch (CommunicationException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }

        if (isset($server['auth'])) {
            if (!$redis->auth($server['auth'])) {
                die('ERROR: Authentication failed ('.$server['host'].':'.$server['port'].')');
            }
        }
        if ($server['db'] != 0) {
            if (!$redis->select($server['db'])) {
                die('ERROR: Selecting database failed ('.$server['host'].':'.$server['port'].','.$server['db'].')');
            }
        };
        self::$redis=$redis;
    }
    public static function redis($server=[]){
        if(self::$redis===null){
            new Redis($server);
        }
        return self::$redis;
    }
    public static function db($db){
        return self::$redis->select($db);
    }
    public static function set_server($server=0,$db=0){
        session('redisServerAndDb',['server'=>$server,'db'=>$db]);
        return self::redis();
    }
    public static function get_server(){
        $server=session('redisServerAndDb');
        $server['server']=isset($server['server'])?$server['server']:0;
        $server['db']=isset($server['db'])?$server['db']:0;
        return $server;
    }
}