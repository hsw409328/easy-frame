<?php

namespace App\Core;

/**
 * 图片操作类
 * Created by PhpStorm.
 * User: haoshuaiwei
 * Date: 2017/4/26
 * Time: 14:48
 */
use Gregwar\Captcha\CaptchaBuilder;

class Image
{
    //本地保存图片路径
    private $_savePaht = WEBPATH . '/Public/download/image/';
    //post图片流接收地址
    private $_imageStreamPostUrl = '';

    private $_imgType = ['gif', 'png', 'jpg', 'jpeg'];

    public function __construct()
    {
    }

    /**
     * POST上传图片流
     */
    public function uploadImgStream($file = NULL)
    {
        if (!$file) {
            return false;
        }
        $f = $file ['tmp_name'];
        if (!$f) {
            return false;
        }
        $imgType = $file ['type'];
        if (array_search(strtolower($imgType), $this->_imgType) === false) {
            return false;
        }
        $fileSize = filesize($f);
        $pictureData = fread(fopen($f, "r"), $fileSize);
        $fileType = explode('/', $imgType);
        $head = array("Content-Type:" . $fileType ['1']);
        $res = Curl::post($pictureData, $this->_imageStreamPostUrl, $head);
        return $res;
    }

    /**
     * 保存远程图片到本地
     */
    public function saveImageLocal($url_img, $savepath = '')
    {
        if (empty($savepath)) {
            $savepath = $this->_savePaht . date('Ymd') . '/';
        }

        if (!is_dir($savepath)) {
            mkdir($savepath, 755, true);
        }

        $file_arr = explode('.', $url_img);
        $file_ext = end($file_arr);
        if (array_search(strtolower($file_ext), $this->_imgType) === false) {
            return false;
        }

        $imageStream = Curl::get($url_img);
        if (!$imageStream) {
            return false;
        }
        $saveFileName = $savepath . uniqid() . '.' . $file_ext;
        $hd = fopen($saveFileName, 'a');
        fwrite($hd, $imageStream);
        fclose($hd);
        return ['file_name' => $saveFileName];
    }

    /**
     * 验证码
     * @desc 使用者，请从session获取validateNumber
     * @param int $width 宽
     * @param int $height 高
     * @param null $font 字体
     * @param null $fingerprint 指印
     */
    public function validateImage($width = 150, $height = 40, $font = null, $fingerprint = null)
    {
        $builder = new CaptchaBuilder();
        $builder->build($width, $height, $font, $fingerprint);
        $_SESSION[WEBSESSION]['validateNumber'] = $builder->getPhrase();
        header('Content-type: image/jpeg');
        $builder->output();
    }
}