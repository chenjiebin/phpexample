<?php

echo gmp_add(1, 2);
echo PHP_EOL;

echo gmp_pow(2, 31);
echo PHP_EOL;


echo $a = combination(1024, 500);
echo PHP_EOL;

echo $b = gmp_pow(2, 1024);
echo PHP_EOL;

echo gmp_div($a, $b, GMP_ROUND_MINUSINF);
echo PHP_EOL;


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


