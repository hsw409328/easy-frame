<?php
/**
 * Created by PhpStorm.
 * User: haoshuaiwei
 * Date: 2017/4/25
 * Time: 18:58
 */
namespace App\Apps\Controller;
use App\Core\Curl;

use App\Core\Controller;

class Curltest extends Controller
{
    function __construct()
    {
        $rs = Curl::get('www.baidu.com');
        var_dump($rs);
    }
}