<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:13
 */

namespace App\Apps\Controller;

use App\Core\Core;
use App\Core\Redis;
use App\Core\Image;

class Test extends \App\Core\Controller
{

    function index()
    {
        $obj = new \App\Apps\Model\Test();
        $dbRs = $obj->getAll();
        foreach ($dbRs as $k => $v) {
            var_dump($v['name']);
        }
        echo $this->_jsonEn(1, '成功');
    }

    function test()
    {
        var_dump($_SERVER);
    }

    function configAll()
    {
        var_dump(Core::$config);
    }

    function testview()
    {
        $this->display('index/index');
    }

    function testassign()
    {
        //$obj = new \App\Apps\Model\Test();
        //$dbRs = $obj->getAll();
        $this->assign(['res' => '123123']);
        $this->display('test/assign');
    }

    function testredis()
    {
        $obj = Redis::getInstance();
        $obj->set('test', 'test');
        echo $obj->get('test');
    }

    function curlimg()
    {
        $imgurl = $this->input('url');
        if (empty($imgurl)) {
            $this->_jsonEn(0, '未找到参数');
        }
        $obj = new Image();
        $rs = $obj->saveImageLocal($imgurl);
        if (!$rs) {
            $this->_jsonEn(2, '类型不匹配');
        }
        $this->_jsonEn(1, $rs);
    }

    function validateImage()
    {
        $obj = new Image();
        $obj->validateImage();
        die();
    }
}