<?php
/**
 * 计算恒生指数的牛熊比
 */

$niu_xiong_bi = ['niu_value' => 0, 'xiong_value' => 0]; // 单位k

$content = file_get_contents('800000.csv');
$content =  mb_convert_encoding($content, 'utf8', 'utf16');
$arr = explode("\n", $content);
$i = 0;
foreach ($arr as $v) {
    echo ++$i;
    echo PHP_EOL;
    if ($i <= 1) {
        continue;
    }
    $item = explode("\t", $v);
    print_r($item);
    if (count($item) < 7) {
        continue;
    }

    $value = 0;
    if (strpos($item['5'], 'M') !== false) {
        $value = intval($item[5]) * 1000;
    } else if (strpos($item['5'], 'K') !== false) {
        $value = intval($item[5]);
    }
    if ($item['2'] == '牛') {
        $niu_xiong_bi['niu_value'] += $value;
    } else {
        $niu_xiong_bi['xiong_value'] += $value;
    }
    echo "value:" . $value;
    echo PHP_EOL;
    if ($item['6'] == '-') { // 没有成交价
        continue;
    }

//    $money = $value * $item[6];
//    echo "money:" . $money;
//    echo PHP_EOL;
//    if ($item['2'] == '牛') {
//        $niu_xiong_bi['niu'] += $money;
//    } else {
//        $niu_xiong_bi['xiong'] += $money;
//    }
//    echo PHP_EOL;
}
print_r($niu_xiong_bi);

echo $niu_xiong_bi['niu_value'] / array_sum($niu_xiong_bi) * 100;
echo " : ";
echo $niu_xiong_bi['xiong_value'] / array_sum($niu_xiong_bi) * 100;
echo PHP_EOL;


