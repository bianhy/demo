<?php
/**
 * Created by PhpStorm.
 * User: bianhy
 * Date: 2020/7/22
 * Time: 17:45
 */

//swoole定时器
$start = time();

$callback = function ($time_id,$param) use($start) {

    $now = time();

    echo 'param:'.$param.' now:'.$now.PHP_EOL;
    if (($now - $start) > 180){
        swoole_timer_clear($time_id);
    }
};

$a = [22222,33333,44444];

foreach ($a as $value){
    swoole_timer_tick(1000,$callback,$value);
}