<?php
// 计算一个企业的估值方法
// 使用净利润对比的方式
// 估算港股

// 港币兑换比例
$rmb_2_gb = 1.1018;

// 去年情况
$total_stock_issue = 91.27 * 10000; // 总股本，单位万
$last_year_net_profits = 52.07 * 10000; // 去年净利润，单位万元
$last_year_bonus = 0.29; // 去年每股分红，单位元
$last_year_net_income_per_share = $last_year_net_profits / $total_stock_issue; // 去年每股净收益
echo '去年每股净收益：' . $last_year_net_income_per_share;
echo PHP_EOL;

echo PHP_EOL;

// 计算今年情况
$this_year_net_profits = 31 * 10000; // 预计今年净利润，单位万元
$this_year_net_income_per_share = $this_year_net_profits / $total_stock_issue; // 今年每股净收益
echo '今年每股净收益：' . $this_year_net_income_per_share;
echo PHP_EOL;
$this_year_bonus = $this_year_net_income_per_share * $last_year_bonus / $last_year_net_income_per_share;
$this_year_bonus_gb = $this_year_bonus * $rmb_2_gb;
echo '今年每股分红：' . $this_year_bonus . ' 元, ' .  ' 港币：' . $this_year_bonus_gb;
echo PHP_EOL;

echo PHP_EOL;

// 股价估值预计
// 分别按照3%、4%、5%的收益率进行预计
$valuation_3 = $this_year_bonus_gb * 100 / 3;
$valuation_4 = $this_year_bonus_gb * 100 / 4;
$valuation_5 = $this_year_bonus_gb * 100 / 5;
echo '按照3%的股息率：' . $valuation_3;
echo PHP_EOL;
echo '按照4%的股息率：' . $valuation_4;
echo PHP_EOL;
echo '按照5%的股息率：' . $valuation_5;
echo PHP_EOL;
// 股价估值评价
$valuation_avg = ($valuation_3 + $valuation_4 + $valuation_5) / 3;
echo '估值平均：' . $valuation_avg;
echo PHP_EOL;
// 股价估值波动
$valuation_range_min = $valuation_avg * 0.9;
$valuation_range_max = $valuation_avg * 1.1;
echo '估值波动：' . $valuation_range_min . ' ~ ' . $valuation_range_max;
echo PHP_EOL;

