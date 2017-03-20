<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:13
 */
namespace App\Apps\Controller;

use App\Core\Core;

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
        $obj = new \App\Apps\Model\Test();
        $dbRs = $obj->getAll();
        $this->assign(['res' => $dbRs]);
        $this->display('test/assign');
    }
}