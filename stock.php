<?php

$x = intval($_GET['x']); //每笔交易费用
if (!$x) {
    die('x error');
}
$list = range(5000, 50000, 1000);
foreach ($list as $_x) {
    $fee = calc_fee($_x);
    echo $_x . ' ' . round($fee / $_x * 100, 5) . '%';
    echo '<br />';
}


function calc_fee($x)
{
    // 平台佣金 + 平台使用费 + 印花税 + 交收费 + 交易费 + 交易徵費 + 交易系統使用費
    $fee = (($x * 0.0003) >= 3 ? ($x * 0.0003) : 3)
        + 15
        + ceil($x * 0.001)
        + 2
        + round($x * 0.00005, 2)
        + round($x * (0.2 / 7620), 2)
        + 0.5;
    return $fee;
}