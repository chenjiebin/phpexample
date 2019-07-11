<?php

// 计算掷硬币的概率

// 掷硬币10次, 10次都为反面的概率
//$rate = 1 / 2;
//echo pow($rate, 10);
//echo PHP_EOL;

// 由此推算 N次为反面的概率
//for ($i = 0; $i < 10; $i++) {
//    echo ($i + 1) . ': ' . pow($rate, $i + 1);
//    echo PHP_EOL;
//}

// 10个硬币, 5个朝上的几率
// C(10, 5) / 2^10
$case_count = 2;
$total = 10;
$sample_total = 5;
echo calcRate($case_count, $total, $sample_total);
echo PHP_EOL;


/**
 * 计算组合数C($m, $n)
 * @param $m
 * @param $n
 * @return float|int
 */
function combination($m, $n)
{
    $result = 1;
    $a = [];
    for ($i = $m; $i > $n; $i--) {
        $a[] = $i;
    }
    $b = [];
    for ($i = 1; $i <= $n; $i++) {
        $b[] = $i;
    }
    while ($a || $b) {
        $result = $result * array_pop($a) / array_pop($b);
    }
    return $result;
}

/**
 * 进行若干次实验, 指定实验结果出现N次的概率
 * @param int $case_count 出现的样例情况次数, 比如掷硬币就只有正反两种情况
 * @param int $total 实验总次数
 * @param int $sample_total 指定实验结果出现次数
 * @return float
 */
function calcRate($case_count, $total, $sample_total)
{
    return combination($total, $sample_total) / pow($case_count, $total);
}