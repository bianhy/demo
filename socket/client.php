<?php
/**
 * Created by PhpStorm.
 * User: bianhy
 * Date: 2019/5/30
 * Time: 16:33
 */

set_time_limit(0);
ini_set("display_errors", "off");
error_reporting(0);
$client_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$connect = socket_connect($client_socket, '127.0.0.1', 8300);
if(!$connect){
    echo '连接失败！';exit;
}
if(isset($argv[1]))
{
    $send = 'client value '.$argv[1];
}
else
{
    $send = "default";
}
socket_write($client_socket, $send.mt_rand(1000,9999)."\r\n");
$response = socket_read($client_socket, 1024000);
echo "server: ".$response;
socket_close($client_socket);