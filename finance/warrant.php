<?php
$str = file_get_contents('./finance/xiong.txt');

$array = explode("\n", $str);
print_r($array);
$xiong_total = '';
foreach ($array as $v) {
    $temp = $v;
    if (strpos($v, 'M') !== false) {
        $temp = floatval(str_replace('M', '', $v)) * 1000000;
    } else if (strpos($v, 'K') !== false) {
        $temp = floatval(str_replace('K', '', $v)) * 1000;
    }
    echo $temp . PHP_EOL;
    $xiong_total += $temp;
}
echo $xiong_total / 1000000 . 'M';
echo PHP_EOL;

