<?php

// 计算富途牛牛费用

$x = intval($_GET['x']); //每笔交易费用
if (!$x) {
    die('x error');
}

echo $x . ' ' . calc_fee($x) . ' ' . round(calc_fee($x) / $x * 100, 5) . '%';
echo '<br />';
echo '<br />';

$list = range(5000, 500000, 1000);
foreach ($list as $_x) {
    $fee = calc_fee($_x);
    echo $_x . ' ' . $fee . ' ' . round($fee / $_x * 100, 5) . '%';
    echo '<br />';
}


function calc_fee($x)
{
    // 平台佣金 + 平台使用费 + 印花税 + 交收费 + 交易费 + 交易徵費 + 交易系統使用費
    $fee1 = (($x * 0.0003) >= 3 ? ($x * 0.0003) : 3);
    $fee2 = 15;
    $fee3 = ceil($x * 0.001);
    $fee4 = 2;
    $fee5 = round($x * 0.00005, 2);
    $fee6 = round($x * (0.2 / 7260), 2);
    $fee7 = 0.5;
    $fee = $fee1 + $fee2 + $fee3 + $fee4 + $fee5 + $fee6 + $fee7;
//    echo "$fee1 + $fee2 + $fee3 + $fee4 + $fee5 + $fee6 + $fee7";
//    echo '<br />';
    return $fee;
}