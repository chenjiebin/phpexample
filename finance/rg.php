<?php
// 计算rg
// http://survivor99.com/lcg/mantan.htm

$F1 = 0.3; // 亏钱的几率
$r1 = -0.01; // 亏钱的幅度
$F2 = bcsub(1, $F1, 2);// 赚钱的几率
$r2 = 0.05; // 赚钱的幅度

// 硬币联系
//$F1 = 0.5; // 亏钱的几率
//$r1 = -1; // 亏钱的幅度
//$F2 = 0.5;// 赚钱的几率
//$r2 = 2; // 赚钱的幅度


$good_q = null;
$max_rg = 0;
$rg = 0;
for ($q = 0.01; bccomp($q, 1, 2) !== 1; $q += 0.01) {
    echo $q * 100 . '%' . '<br />';
    $rg = pow(1 + $r1 * $q, $F1) * pow(1 + $r2 * $q, $F2);
    echo $rg . '<br />';
    if (bccomp($max_rg, $rg, 10) === -1) {
        $good_q = $q;
        $max_rg = $rg;
    }
}

var_dump($good_q * 100, $max_rg, $rg, bccomp($max_rg, $rg, 2));