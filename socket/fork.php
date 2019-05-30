<?php
/**
 * Created by PhpStorm.
 * User: bianhy
 * Date: 2019/5/30
 * Time: 16:34
 */

$common = sprintf('php %s %s','/data/wwwroot/test/client.php',mt_rand(1000,9999));

$max   = 5;//最大的子进程数量
$child = 0;//当前的子进程数量
$num   = 1;

while (true) {
    $child++;
    $pid = pcntl_fork();
    if ($pid) {
        if ($child >= $max) {
            pcntl_wait($status);
            $child--;
        }
    } else {
        while (true) {
            exec($common);echo ' 进程id:'.getmypid().' num:'.$num.PHP_EOL;
            $num++;
        }
    }
}
