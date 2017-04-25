<?php

namespace App\Core;

use MongoDB\Driver\Exception\ExecutionTimeoutException;

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
    private $_redisObject = null;

    private function __construct()
    {
        try {
            $this->_redisObject = new \Redis();
            $this->_redisObject->connect(Core::$config['redis']['host'], Core::$config['redis']['port']);
        } catch (ExecutionTimeoutException $e) {
            var_dump($e->getMessage());
        }
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
        $rs = $this->_redisObject->get($key);
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
        $this->_redisObject->set($key, $value);
    }

    /**
     * 设置一个带过期时间的缓存，非持久化存储
     * @param $key
     * @param $value
     * @param int $timeout
     */
    public function setEx($key, $value, $timeout = 3600)
    {
        $this->_redisObject->setex($key, $timeout, $value);
    }

    /**
     * 获取一个
     * @param $key
     * @return mixed
     */
    public function getTtl($key)
    {
        return $this->_redisObject->ttl($key);
    }

}