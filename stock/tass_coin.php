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
//$case_count = 2;
//$total = 12;
//$sample_total_list = [1 => 5, 2 => 7];
//calcNextRate($case_count, $total, $sample_total_list);

test();

function test()
{
    $array = [];
    for ($i = 0; $i < 1000; $i++) {
        $array[] = mt_rand(1, 2);
    }

    $case_count = 2;
    $now_total = 1000;
    $sample_total_list = [1 => 0, 2 => 0];
    foreach ($array as $v) {
        $sample_total_list[$v]++;
    }

    $guess_total = 30;
    $guess_success_total = 0;
    for ($i = 0; $i < $guess_total; $i++) {
        // 猜测下次出现什么情况
        $next_rate_percent_list = calcNextRate($case_count, $now_total, $sample_total_list);
        $guess_case = -1;
        $temp_rate_percent = -1;
        foreach ($next_rate_percent_list as $case => $next_rate_percent) {
            if (bccomp($temp_rate_percent, $next_rate_percent, 2) === -1) {
                $guess_case = $case;
                $temp_rate_percent = $next_rate_percent;
            }
        }
        echo '$guess_case: ' . $guess_case . PHP_EOL;

        // 真实的随机
        $real_case = mt_rand(1, 2);
        echo '$real_case: ' . $real_case . PHP_EOL;

        // 对比猜测和真实的
        if (bccomp($guess_case, $real_case, 2) === 0) {
            $guess_success_total++;
        }

        // 累加一下实验总数
        $now_total += 1;
        $sample_total_list[$real_case]++;

        echo PHP_EOL;
    }
    echo '$guess_success_total:' . $guess_success_total . '';
    echo PHP_EOL;
}

/**
 * 计算下一次出现的概率
 * @param int $case_count 出现的样例情况次数, 比如掷硬币就只有正反两种情况
 * @param int $total 实验总次数
 * @param array $sample_total_list 实验结果出现次数列表 [$sample_total_1, $sample_total_2...]
 * @return array 每种情况出现的百分比概率, [49, 51]
 */
function calcNextRate($case_count, $total, $sample_total_list)
{
    echo json_encode(func_get_args()) . PHP_EOL;
    $sample_rate_list = [];
    foreach ($sample_total_list as $case => $sample_total) {
        $sample_rate = calcRate($case_count, $total + 1, $sample_total + 1);
        $sample_rate_list[$case] = $sample_rate;
    }
    echo '$sample_rate_list: ' . json_encode($sample_rate_list) . PHP_EOL;
    $sample_rate_percent_list = [];
    $sample_rate_list_sum = array_sum($sample_rate_list);
    foreach ($sample_rate_list as $case => $sample_rate) {
        $sample_rate_percent = $sample_rate / $sample_rate_list_sum * 100;
        $sample_rate_percent_list[$case] = $sample_rate_percent;
    }
    echo '$sample_rate_percent_list: ' . json_encode($sample_rate_percent_list) . PHP_EOL;
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
//    echo '$a: ' . json_encode($a) . PHP_EOL;
//    echo '$b: ' . json_encode($b) . PHP_EOL;
    $result = 1;
    while ($a || $b) {
        $temp_a = $a ? array_pop($a) : 1;
        $temp_b = $b ? array_pop($b) : 1;
        $result = gmp_div(gmp_mul($result, $temp_a), $temp_b);
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
    $pow = gmp_pow($case_count, $total);
    return $combination / $pow;
}