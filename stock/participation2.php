<?php
// 计算一下分红后再买入，持有若干年后的情况
// 这边假设股价每年有相应变化
$start_price = 1.963; // 初始股价
$end_price = 4.347; // 最终股价
$year = 8; // 持有年数
$rate = 9.12 / 100; // 股息率
$count = 10000; // 股数

participation($start_price, $end_price, $year, $rate, $count);

function participation($start_price, $end_price, $year, $rate, $count)
{
    // 1. 计算一下股价年变化率
// 公式：(1 + 收益率) ^ 年数 * 初始股价 = 最终股价
//    $start_price = 1.963; // 初始股价
//    $end_price = 4.347; // 最终股价
//    $year = 8; // 持有年数
    $price_year_yield_rate = (pow($end_price / $start_price, 1 / $year) - 1);
    echo 'start_price: ' . $start_price;
    echo PHP_EOL;
    echo 'price_year_yield_rate: ' . $price_year_yield_rate; // 股价年变化率
    echo PHP_EOL;

// 2. 后面开始计算每年分红后再买入的场景
    $price = $start_price; // 初始股价
//    $rate = 9.12 / 100; // 股息率
//    $count = 10000; // 股数
    $capital = $price * $count; // 本金
    echo 'capital: ' . $capital;
    echo PHP_EOL;

// 公式
// 每年分红：（股数 * 股价）* 股息率
// 除权后价格： 股价 * ( 1 - 股息率 )
// 每年增加股数：每年分红 / 除权后价格
    echo PHP_EOL;
    for ($i = 0; $i < $year; $i++) {
        $price = $price * (1 + $price_year_yield_rate);
        $add_count = floor(($count * $price) * $rate / ($price * (1 - $rate)));
        $count = $count + $add_count;

        echo 'year ' . ($i + 1) . ': ' . ' price=' . $price . ' count=' . $count . ' add_count=' . $add_count;
        echo PHP_EOL;
    }
    echo PHP_EOL;

    echo 'price: ' . $price;
    echo PHP_EOL;
    echo 'count: ' . $count;
    echo PHP_EOL;
    $total_price = ($count * $price); // 总资产
    echo 'total price: ' . $total_price;
    echo PHP_EOL;

// 计算一下年化收益率
// 由复利公式： (1 + 收益率) ^ 年数 * 本金 = 总资产
// 得到：收益率 = ( (总资产 / 本金) 开根号 年数 ) - 1
    echo 'year yield rate: ' . (pow($total_price / $capital, 1 / 10) - 1);
    echo PHP_EOL;
}

