<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/20
 * Time: 上午11:47
 */

namespace App\Apps\Controller;

use App\Core\Core;

use App\Core\Controller;

class Hello extends Controller
{

    public function __construct()
    {
        $this->index();
    }

    function index()
    {
        $this->assign('web_title', Core::$config['config']['web_title']);
        $this->assign('web_desc', Core::$config['config']['web_desc']);
        $this->assign('web_keyword', Core::$config['config']['web_keyword']);
        $this->assign('test', 'Hello Wolrd!');
        $this->display('hello/index');
    }
}