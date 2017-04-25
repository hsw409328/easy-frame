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

class Json extends \App\Core\Controller
{
    function __construct()
    {
        parent::__construct();
        $arr = [1=>['abc'=>'2','asdfa'],2,3,4,5,6,7];
        $j = json_encode($arr);
        $j = json_decode($j);
        foreach ($j as $k=>$v){
            var_dump($v);
        }
    }
}