<?php
/**
 * Created by PhpStorm.
 * User: hsw
 * Date: 17/3/17
 * Time: 下午4:41
 */
namespace App\Core;

class Controller
{
    public $template_dir = 'view';
    public $_tpl_var = [];

    function __construct()
    {

    }

    function __call($name, $arguments)
    {
        if (WEBLOG) {
            \App\Core\Log::write('controller_func_error.log', $name . '-方法不存在' . date('Y-m-d H:i:s') . "-error\n");
        }
        header("HTTP/1.0 404 Not Found");
        exit();
    }

    function _jsonEn($code, $rs)
    {
        echo json_encode(['code' => $code, 'result' => $rs]);
        exit();
    }

    /**
     * view视图
     * @param $filename
     */
    function display($filename)
    {
        if (stripos($filename, '.php') == false) {
            $filename .= '.php';
        }

        $tplFile = WEBPATH . '/Apps/' . $this->template_dir . '/' . $filename;

        if (!file_exists($tplFile)) {
            $this->_jsonEn(0, $tplFile . '模板文件不存在');
        }

        $parseFile = WEBPATH . '/Cache/template/' . md5($filename) . '.php';

        $putRs = $this->parseVar($tplFile, $parseFile);
        if ($putRs) {
            //走模板解析
            include_once $parseFile;
        } else {
            //映射数组到变量不走模板解析过程
            extract($this->_tpl_var);
            include_once $tplFile;
        }
    }

    function parseVar($tplFile, $parse_file)
    {
        $pattern = '/\{\$([\w\d]+)\}/';
        $content = file_get_contents($tplFile);
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, '<?php echo \$this->_tpl_var["$1"];?>', $content);
            file_put_contents($parse_file, $content);
            return true;
        } else {
            return false;
        }
    }

    function assign($name, $value = '')
    {
        if (is_array($name)) {
            $this->_tpl_var = array_merge($this->_tpl_var, $name);
        } else {
            $this->_tpl_var [$name] = $value;
        }
    }

}