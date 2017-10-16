<?php
// 原字符串大小
$str = file_get_contents('./text.log');
echo 'origin size: ' . (strlen($str) / 1024) . 'k';
echo '<br />';

// 比较不同压缩等级
for ($i = 0; $i < 10; $i++) {
    $gz_content = gzcompress($str, $i);
    echo $i . ': ';
    echo (strlen($gz_content) / 1024) . 'k';
    echo '<br />';
}

// 查看压缩和解压后内容
$gz_content = gzcompress($str, 1);
echo gzuncompress($gz_content);