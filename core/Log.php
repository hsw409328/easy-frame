<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午7:56
 */
namespace App\Core;

class Log
{
    static $logDir = "/console/log/";

    static function write($filename, $msg, $dir_name = '')
    {
        $logDir = WEBPATH . self::$logDir . $dir_name;

        if (!is_dir($logDir)) {
            try {
                mkdir($logDir, 0777, true);
            } catch (\Exception $e) {
                die($e->getMessage());
            }

        }

        $hd = fopen($logDir . $filename, 'a+');
        fwrite($hd, $msg);
        fclose($hd);
    }

    static function read($filename, $dir_name = '')
    {
        $logDir = WEBPATH . self::$logDir . $dir_name;
        return file_get_contents($logDir . $filename);

    }
}