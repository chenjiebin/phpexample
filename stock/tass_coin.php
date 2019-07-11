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
$sample_total_1 = 5;

calcNextRate($case_count, $total, $sample_total_1);

function calcNextRate($case_count, $total, $sample_total_1)
{
    $sample_total_2 = $total - $sample_total_1;

    $sample_1_rate = calcRate($case_count, $total + 1, $sample_total_1 + 1);
    echo $sample_1_rate;
    echo PHP_EOL;

    $sample_2_rate = calcRate($case_count, $total + 1, $sample_total_2 + 1); // 另外一种情况概率
    echo $sample_2_rate;
    echo PHP_EOL;

    $sample_1_rate_percent = $sample_1_rate / ($sample_1_rate + $sample_2_rate) * 100;
    $sample_2_rate_percent = $sample_2_rate / ($sample_1_rate + $sample_2_rate) * 100;
    echo '$sample_1_rate_percent: ' . $sample_1_rate_percent . '%';
    echo PHP_EOL;
    echo '$sample_2_rate_percent: ' . $sample_2_rate_percent . '%';
    echo PHP_EOL;
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