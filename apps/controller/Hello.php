<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/20
 * Time: 上午11:47
 */
namespace App\Apps\Controller;

use App\Core\Controller;

class Hello extends Controller
{
    function index()
    {
        $this->assign('test', 'Hello Wolrd!');
        $this->display('hello/index');
    }
}