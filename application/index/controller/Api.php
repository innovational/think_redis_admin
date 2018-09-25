<?php
/**
 * Created by PhpStorm.
 * User: wenwu
 * Date: 2018/9/8
 * Time: 23:29
 */
namespace app\index\controller;
use redis\Redis;
use think\Controller;

class Api extends Controller {
    public function __construct(){
        parent::__construct();
        if(!request()->isAjax()){
            echo '404';
            exit;
        }
    }

    //获取key 列表
    public function get_all_key(){
        $key=input('key','');
        $key.='*';
        $keyList=[];
        $redis=Redis::redis();
        $page=0;
        while (true){
            $info=$redis->scan($page,'MATCH', $key, 'COUNT', 1000);
            $page=isset($info[0])?$info[0]:0;
            $list=isset($info[1])?$info[1]:[];
            $keyList=array_merge($keyList,$list);
            if($page==0)break;
        }
        sort($keyList);
        return ['code'=>1,'data'=>$keyList];
    }

    //获取key info
    public function key_info(){
        $key=input('key','');
        if(empty($key))return ['code'=>0,'msg'=>'请选择key'];
        $redis=Redis::redis();
        $type=(string)$redis->type($key);
        $ttl=$redis->ttl($key);
        $encoding = $redis->object('encoding',$key);
        switch ($type){
            case 'string':
                $data=$redis->get($key);
                $size=strlen($data);
                break;
            case 'list':
                $size=$redis->llen($key);
                $data=[];
                for ($i=0;$i<$size;$i++){
                    $data[]=$redis->lindex($key,$i);
                }
                break;
            case 'hash':
                $data=$redis->hgetall($key);
                $size=count($data);
                break;
            case 'set':
                $data=$redis->smembers($key);
                $size=count($data);
                break;
            case 'zset':
                $data=$redis->zrange($key,0,-1,['WITHSCORES'=>true]);
                $data=array_flip($data);
                $size=count($data);
                break;
            default :
                $size=0;$data='';
                break;
        }
        $data=[
            'type'=>$type,
            'ttl'=>$ttl,
            'encoding'=>$encoding,
            'size'=>$size,
            'data'=>$data
        ];
        return ['code'=>1,'data'=>$data];
    }

    //更改 key 名称
    public function rename(){
        $key=input('key','');
        $now_key=input('now_key','');
        if(empty($key))return ['code'=>0,'msg'=>'请选择key'];
        if(empty($now_key))return ['code'=>0,'msg'=>'请输入新的key'];
        Redis::redis()->rename($key,$now_key);
        return ['code'=>1];
    }

    //设置key过期时间
    public function ttl(){
        $key=input('key','');
        $ttl=(int)(input('ttl')*1);
        if(empty($key))return ['code'=>0,'msg'=>'请选择key'];
        if($ttl===-1)Redis::redis()->persist($key);
        else Redis::redis()->expire($key,$ttl);
        return ['code'=>1];
    }

    //提交保存 表单处理
    public function form_op(){
        $key=input('key','');
        $type=(string)input('type');
        $index=input('index');
        $value=input('value');
        $old_value=input('old_value');
        if(empty($key))return ['code'=>0,'msg'=>'请输入key'];
        if(empty($type))return ['code'=>0,'msg'=>'请选择类型'];
        if(empty($value))return ['code'=>0,'msg'=>'请填写值'];
        $redis=Redis::redis();
        switch ($type){
            case 'string':
                $redis->set($key,$value);
                break;
            case 'list':
                $size = $redis->lLen($key);
                if (!$size || ($index== '') || ($index>= $size) || ($index < 0)) {
                    $redis->rpush($key,$value);
                }else{
                    $redis->lset($key,$index,$value);
                }
                break;
            case 'hash':
                if(empty($index))return ['code'=>0,'msg'=>'请填写hash key'];
                $redis->hset($key,$index,$value);
                break;
            case 'set':
                if($old_value!=$value) {
                    if ($old_value) $redis->srem($key, $value);
                    $redis->sadd($key,$value);
                }
                break;
            case 'zset':
                if($old_value)$redis->zrem($key,$old_value);
                $redis->zadd($key,$index,$value);
                break;
            default:break;
        }
        return ['code'=>1];
    }

    //获取redis 信息
    public function get_redis(){
        $config=config('redis.');
        $redisList=[];
        foreach ($config as $k=>$v){
            $redisList[$k]=$v['name'];
        }
        $select=Redis::get_server();
        return ['code'=>1,'data'=>['select'=>$select,'redisList'=>$redisList]];
    }

    //切换redis
    public function set_redis(){
        $server=intval(input('server'));
        $db=intval(input('db'));
        if(empty($server) && $server!==0)return ['code'=>0,'msg'=>'请选择redis服务'];
        if(empty($db) && $db!==0)return ['code'=>0,'msg'=>'请选择db'];
        if(Redis::set_server($server,$db)){
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>0,'msg'=>'操作失败'];
        }
    }

    //删除值
    public function del_value(){
        $key=input('key','');
        $index=input('index');
        $type=input('type');
        $value=input('value');
        if(empty($key))return ['code'=>0,'msg'=>'请输入key'];
        if(empty($value))return ['code'=>0,'msg'=>'请填写值'];
        if(empty($type))return ['code'=>0,'msg'=>'类型不对'];
        $redis=Redis::redis();
        switch ($type){
            case 'list':
                $value=$value.uniqid('del');
                $redis->lset($key,$index,$value);
                $redis->lrem($key,1,$value);
                break;
            case 'hash':
                $redis->hdel($key,$index);
                break;
            case 'set':
                $redis->srem($key,$value);
                break;
            case 'zset':
                $redis->zrem($key,$value);
                break;
        }
        return ['code'=>1];
    }

    //删除key
    public function del_key(){
        $key=input('key','');
        if(empty($key))return ['code'=>0,'msg'=>'请输入key'];
        Redis::redis()->del($key);
        return ['code'=>1];
    }

    //获取服务信息
    public function get_redis_info(){
        $info=Redis::redis()->info();
        $infos['redis_version']=isset($info['Server']['redis_version'])?$info['Server']['redis_version']:''; //版本
        $infos['uptime_in_days']=isset($info['Server']['uptime_in_days'])?$info['Server']['uptime_in_days']:''; //运行时长
        $infos['used_memory_human']=isset($info['Memory']['used_memory_human'])?$info['Memory']['used_memory_human']:''; //使用内存
        $infos['used_memory_peak_human']=isset($info['Memory']['used_memory_peak_human'])?$info['Memory']['used_memory_peak_human']:''; //内存使用峰值
        $infos['last_save_time']=isset($info['Persistence']['rdb_last_save_time'])?$info['Persistence']['rdb_last_save_time']:0; //上次保存时间
        $infos['used_cpu_sys']=isset($info['CPU']['used_cpu_sys'])?$info['CPU']['used_cpu_sys']:''; //cpu使用
        $infos['aof']=isset($info['AOF'])?'开启AOF':'未使用AOF'; //cpu使用
        $infos['size']=Redis::redis()->dbsize(); //大小
        $infos['uptime_in_days'].='天';
        $infos['last_save_time']=date('Y-m-d H:i',$infos['last_save_time']);
        return ['code'=>1,'data'=>$infos];
    }
}