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
echo combination(10, 5) / pow(2, 10);
echo PHP_EOL;

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