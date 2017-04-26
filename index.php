<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:11
 */
define('ERROR_INIT', 'on');
define('DEBUG', 'on');
define('WEBPATH', __DIR__);
define('WEBROOT', 'http://ef.jd.com');
define('WEBSESSION', 'efjdcom');
define('WEBLOG', 1);
define('ENVIRONMENT', isset($_SERVER['API_ENV']) ? $_SERVER['API_ENV'] : 'dev');

//bootstrap sytle
define('BS_CSS', WEBROOT . '/vendor/twbs/bootstrap/dist/Css/');
define('BS_JS', WEBROOT . '/vendor/twbs/bootstrap/dist/js/');
define('TH_JS', WEBROOT . '/vendor/bordercloud/tether/dist/js/tether.js');
define('JQ_JS', WEBROOT . '/vendor/components/jquery/jquery.min.js');

if (ERROR_INIT == 'on') {
    ini_set("display_errors", "On");
}

require_once __DIR__ . '/vendor/autoload.php';

switch (ENVIRONMENT) {
    case 'dev':
        App\Core\Core::loadConfig(WEBPATH . '/Apps/Config/dev/');
        break;
    case 'pro':
        App\Core\Core::loadConfig(WEBPATH . '/Apps/Config/pro/');
        break;
    default:
        App\Core\Core::loadConfig(WEBPATH . '/Apps/Config/dev/');
        break;
}

App\Core\Core::runMVC();