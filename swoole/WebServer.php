<?php


class WebServer
{
    public $server;

    protected function __construct($host, $port)
    {
        $this->server = new \swoole_server($host, $port);

        $this->server->set([
            'worker_num' => 4,
            'daemonize' => false,
            'backlog' => 128
        ]);
        $this->server->on('connect', array($this, 'onConnect'));
        $this->server->on('receive', array($this, 'onReceive'));
        $this->server->on('task', array($this, 'onTask'));
        $this->server->on('finish', array($this, 'onFinish'));
        $this->server->on('close', array($this, 'onClose'));
        $this->server->on('start', array($this, 'onStart'));
    }

    public function onConnect(swoole_server $server, $fd, $from_id)
    {
        echo 'connect from_id:' . $from_id . ' fd:' . $fd;
    }

    public function onReceive(swoole_server $server, $fd, $from_id, $data)
    {
        var_dump($data);
    }

    public function onTask(swoole_server $server, $task_id, $from_id, $data)
    {
        return true;
    }

    public function onFinish(swoole_server $server, $task_id, $data)
    {

    }

    public function onClose(swoole_server $server, $fd, $from_id)
    {
    }

    public function onStart(swoole_server $server)
    {
        echo 'version:' . swoole_version() . ' server start :' . date('Y-m-d H:i:s') . ' pid :' . $server->master_pid . PHP_EOL;
    }

    public static function run($host, $port)
    {
        $server = new self($host, $port);
        $server->server->start();
    }
}

WebServer::run('0.0.0.0', 9502);