<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午8:19
 */
namespace App\Apps\Model;

use App\Core\MyPDO;

class Test
{
    function getAll()
    {
        $query = MyPDO::getInstance()->query('select * from actions');
        return $query;
    }
}