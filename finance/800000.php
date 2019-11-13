<?php
/**
 * 计算恒生指数的牛熊比
 */

$niu_xiong_bi = ['niu' => 0, 'xiong' => 0]; // 单位k

$content = file_get_contents('800000.txt');
$arr = explode("\n", $content);
$i = 0;
foreach ($arr as $v) {
    echo ++$i;
    echo PHP_EOL;
    if ($i <= 1) {
        continue;
    }
    $item = explode("\t", $v);
    $value = intval($item[5]);
    if (strpos($item['5'], 'M') !== 0) {
        $value = intval($item[5]) * 1000;
    }
    print_r($item);
    if ($item['6'] == '-') { // 没有成交价
        continue;
    }
    if ($item['2'] == '牛') {
        $niu_xiong_bi['niu'] += $value * $item[6];
    } else {
        $niu_xiong_bi['xiong'] += $value * $item[6];
    }
}
print_r($niu_xiong_bi);

echo $niu_xiong_bi['niu'] / array_sum($niu_xiong_bi) * 100;
echo " : ";
echo $niu_xiong_bi['xiong'] / array_sum($niu_xiong_bi) * 100;
echo PHP_EOL;


