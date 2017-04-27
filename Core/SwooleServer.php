<?php

namespace App\Core;
/**
 * Created by PhpStorm.
 * User: haoshuaiwei
 * Date: 2017/4/27
 * Time: 11:13
 */
class SwooleServer
{
    public $_serv = null;
    public $_host = '0.0.0.0';
    public $_port = '9001';


    public function __construct()
    {
        $this->_serv = new \swoole_server($this->_host, $this->_port);
        $this->_serv->on('Connect', [$this, 'onConnect']);
        $this->_serv->on('Receive', [$this, 'onReceive']);
        $this->_serv->start();
    }

    public function onConnect($serv, $fd)
    {

    }

    public function onReceive($serv, $fd, $from_id, $data)
    {
        $this->_serv->send($fd, 'TestSwooleSend:' . $data);
        $this->onClose($serv, $fd);
    }

    public function onClose($serv, $fd)
    {
        $this->_serv->close($fd);
    }
}