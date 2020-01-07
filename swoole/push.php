<?php
/**
 * Created by PhpStorm.
 * User: bianhy
 * Date: 2020/1/6
 * Time: 17:01
 */

//定时推送
$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id
});

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},finish:{$frame->finish}\n";

    swoole_timer_tick(2000, function ($timer_id) use ($server,$frame) {
        if ($server->exist($frame->fd)){
            $server->push($frame->fd, "this is server $timer_id");
        } else {
            //清除定时器
            swoole_timer_clear($timer_id);
        }
    });
});

$server->on('close', function ($server, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();