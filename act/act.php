<?php

//九宫格抽奖算法
//右上角位置为1
//顺时针顺序排列
//奖品配置
$config = [
    [
        'name' => '奖品1',
        'num'  => 10,
        'pos'  => 1,
        'remain_num'  =>10,
        'probability' =>10,
    ],
    [
        'name' => '奖品2',
        'num'  => 10,
        'pos'  => 2,
        'remain_num'  =>10,
        'probability' =>10,
    ],
    [
        'name' => '奖品3',
        'num'  => 1,
        'pos'  => 3,
        'remain_num'  =>1,
        'probability' =>0,
    ],
    [
        'name' => '奖品4',
        'num'  => 20,
        'pos'  => 4,
        'remain_num'  =>10,
        'probability' =>20,
    ],
    [
        'name' => '奖品5',
        'num'  => 8,
        'pos'  => 5,
        'remain_num'  =>8,
        'probability' =>5,
    ],
    [
        'name' => '奖品6',
        'num'  => 6,
        'pos'  => 6,
        'remain_num'  =>6,
        'probability' =>5,
    ],
    [
        'name' => '奖品77',
        'num'  => 7,
        'pos'  => 7,
        'remain_num'  =>7,
        'probability' =>4,
    ],
    [
        'name' => '奖品8',
        'num'  => 8,
        'pos'  => 8,
        'remain_num'  =>8,
        'probability' =>6,
    ],
    [
        'name' => '奖品9',
        'num'  => 9,
        'pos'  => 9,
        'remain_num'  =>9,
        'probability' =>40,
    ]
];

$ret = getPrizeRand($config);


$s = [];
for ($i=0;$i<1000000;$i++){
    $s[] = getPrizeRand($config);
}

var_dump(array_count_values($s));exit;


function getPrizeRand($config)
{
    $result      = '';
    $pro_val_arr = array_column($config, 'probability');
    //概率数组的总概率精度
    $proSum = array_sum($pro_val_arr);

    if (empty($proSum)) {
        $this->outError('奖品概率之和不能为0');
    }
    //打乱数组顺序
    shuffle($config);
    //概率数组循环
    foreach ($config as $key => $proCur) {
        $randNum = mt_rand(0, $proSum);
        //如果随机数，小于等于当前奖品概率，就中奖，否则减去当前概率
        if ($randNum <= $proCur['probability']) {
            $result = $proCur['pos'];
            break;
        } else {
            //减去当概率
            $proSum -= $proCur['probability'];
        }
    }
    unset($proArr);
    return $result;
}

