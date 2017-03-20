<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:11
 */
define('DEBUG', 'on');
define('WEBPATH', __DIR__);
define('WEBROOT', 'http://test.api.com');
define('WEBLOG', 1);
define('ENVIRONMENT', isset($_SERVER['API_ENV']) ? $_SERVER['API_ENV'] : 'dev');

require_once __DIR__ . '/vendor/autoload.php';

switch (ENVIRONMENT) {
    case 'dev':
        App\Core\Core::loadConfig(WEBPATH . '/apps/config/dev/');
        break;
    case 'pro':
        App\Core\Core::loadConfig(WEBPATH . '/apps/config/pro/');
        break;
    default:
        App\Core\Core::loadConfig(WEBPATH . '/apps/config/dev/');
        break;
}

App\Core\Core::runMVC();