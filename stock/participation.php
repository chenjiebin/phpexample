<?php
// 计算一下分红后再买入，持有若干年后的情况

$price = 4.75; // 股价
$rate = 9.12 / 100; // 股息率
$count = 10000; // 股数
$year = 10; // 持有年数
$capital = $price * $count; // 本金
echo 'capital: ' . $capital;
echo PHP_EOL;

// 公式
// 每年分红：（股数 * 股价）* 股息率
// 除权后价格： 股价 * ( 1 - 股息率 )
// 每年增加股数：每年分红 / 除权后价格
for ($i = 0; $i < $year; $i++) {
	$add_count = floor(($count * $price) * $rate / ($price * (1 - $rate)));
	$count = $count + $add_count;
}
echo 'count: ' . $count;
echo PHP_EOL;
$total_price = ($count * $price); // 总资产
echo 'total price: ' . $total_price;
echo PHP_EOL;

// 计算一下年化收益率
// 由复利公式： (1 + 收益率) ^ 年数 * 本金 = 总资产
// 得到：收益率 = ( (总资产 / 本金) 开根号 年数 ) - 1
echo 'year yield rate: ' . ( pow($total_price / $capital , 1/10)  - 1);
echo PHP_EOL;
