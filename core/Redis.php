<?php

namespace App\Core;
/**
 * Redis 单例模式扩展
 * Created by PhpStorm.
 * User: haoshuaiwei
 * Date: 2017/4/24
 * Time: 17:06
 */
class Redis
{
    protected static $_instance = null;

    private function __construct()
    {
        $redisObj = new \Redis();
        $redisObj->connect(Core::$config['redis']['host'], Core::$config['redis']['port']);
        return $redisObj;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 根据key值获取缓存内容
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $rs = self::$_instance->get($key);
        $rs_arr = json_decode($rs, true);
        if (is_null($rs_arr)) {
            return $rs;
        } else {
            return $rs_arr;
        }
    }

    /**
     * 设置一个缓存，不过期，非持久化存储
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        self::$_instance->set($key, $value);
    }

    /**
     * 设置一个带过期时间的缓存，非持久化存储
     * @param $key
     * @param $value
     * @param int $timeout
     */
    public function setEx($key, $value, $timeout = 3600)
    {
        self::$_instance->setex($key, $timeout, $value);
    }

    /**
     * 获取一个
     * @param $key
     * @return mixed
     */
    public function getTtl($key){
        return self::$_instance->ttl($key);
    }

}