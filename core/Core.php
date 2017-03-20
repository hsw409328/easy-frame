<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:17
 */
namespace App\Core;

class Core
{
    static $config = [];

    static function loadConfig($path)
    {
        $dir_file = glob($path . '*.php');
        if (empty($dir_file)) {
            self::setUtf8();
            self::setError('未找到配置文件');
        }
        foreach ($dir_file as $k => $v) {
            $key_name = explode('.', basename($v));
            $key_name = $key_name[0];
            self::$config[$key_name] = include_once $v;
        }
    }

    static function parseRoute()
    {
        $_params = explode('/', $_SERVER['QUERY_STRING']);
        return $_params;
    }

    static function setUtf8()
    {
        header("Content-type: text/html; charset=utf-8");
    }

    static function runMVC()
    {
        $rs = self::parseRoute();
        $class_name = isset($rs[1]) ? $rs[1] : '';
        $class_name = "App\\Apps\\Controller\\" . $class_name;
        if (!class_exists($class_name)) {
            self::setError();
        } else {
            self::setUtf8();
            $obj = new $class_name();
            $func_name = isset($rs[2]) ? $rs[2] : '';
            $obj->$func_name();
        }
    }

    static function setError($msg = '404 Not Found')
    {
        header("HTTP/1.0 404 Not Found");
        die($msg);
    }
}