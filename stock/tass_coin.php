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
$total = 12;
$sample_total_list = [1 => 5, 2 => 7];
calcNextRate($case_count, $total, $sample_total_list);

//function test()
//{
//    $array = [];
//    for ($i = 0; $i < 1000; $i++) {
//        $array[] = mt_rand(1, 2);
//    }
//
//    $case_count = 2;
//    $total = 1000;
//    $sample_total_list = [1 => 0, 2 => 0];
//    foreach ($array as $v) {
//        $sample_total_list[$v]++;
//    }
//    $next_rate_list = calcNextRate($case_count, $total, $sample_total_list);
//}

/**
 * 计算下一次出现的概率
 * @param int $case_count 出现的样例情况次数, 比如掷硬币就只有正反两种情况
 * @param int $total 实验总次数
 * @param array $sample_total_list 实验结果出现次数列表 [$sample_total_1, $sample_total_2...]
 * @return array 每种情况出现的百分比概率, [49, 51]
 */
function calcNextRate($case_count, $total, $sample_total_list)
{
    $sample_rate_list = [];
    foreach ($sample_total_list as $case => $sample_total) {
        $sample_rate = calcRate($case_count, $total + 1, $sample_total + 1);
        $sample_rate_list[$case] = $sample_rate;
    }
    var_dump($sample_rate_list);

    $sample_rate_percent_list = [];
    $sample_rate_list_sum = array_sum($sample_rate_list);
    foreach ($sample_rate_list as $case => $sample_rate) {
        $sample_rate_percent = $sample_rate / $sample_rate_list_sum * 100;
        $sample_rate_percent_list[$case] = $sample_rate_percent;
    }
    var_dump($sample_rate_percent_list);
    return $sample_rate_percent_list;
}

/**
 * 计算组合数C($m, $n)
 * @param $m
 * @param $n
 * @return float|int
 */
function combination($m, $n)
{
    $a = $b = [];
    for ($i = 1; $i <= $n; $i++) {
        $a[] = $m--;
        $b[] = $i;
    }
    $result = 1;
    while ($a || $b) {
        $temp_a = $a ? array_pop($a) : 1;
        $temp_b = $b ? array_pop($b) : 1;
        $result = $result * $temp_a / $temp_b;
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
    $combination = combination($total, $sample_total);
    $pow = pow($case_count, $total);
    return $combination / $pow;
}