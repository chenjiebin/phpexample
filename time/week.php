<?php

/**
 * date相关使用
 */

// 一个待转换的日期列表
$dates = [
    '2019-12-02', // 星期一
    '2019-12-03', // 星期二
    '2019-12-04', // 星期三
    '2019-12-05', // 星期四
    '2019-12-06', // 星期五
    '2019-12-07', // 星期六
    '2019-12-08', // 星期七
];

// D	星期中的第几天，文本表示，3 个字母	Mon 到 Sun
foreach ($dates as $date) {
    echo date('D', strtotime($date));
    echo PHP_EOL;
}
// 输出
//    Mon
//    Tue
//    Wed
//    Thu
//    Fri
//    Sat
//    Sun

echo PHP_EOL;

// l（“L”的小写字母）	星期几，完整的文本格式	Sunday 到 Saturday
foreach ($dates as $date) {
    echo date('l', strtotime($date));
    echo PHP_EOL;
}
// 输出
//    Monday
//    Tuesday
//    Wednesday
//    Thursday
//    Friday
//    Saturday
//    Sunday

echo PHP_EOL;

// N	ISO-8601 格式数字表示的星期中的第几天（PHP 5.1.0 新加）	1（表示星期一）到 7（表示星期天）
foreach ($dates as $date) {
    echo date('N', strtotime($date));
    echo PHP_EOL;
}
// 输出
//    1
//    2
//    3
//    4
//    5
//    6
//    7

echo PHP_EOL;

// w	星期中的第几天，数字表示	0（表示星期天）到 6（表示星期六）
foreach ($dates as $date) {
    echo date('w', strtotime($date));
    echo PHP_EOL;
}
// 输出
//    1
//    2
//    3
//    4
//    5
//    6
//    0

echo PHP_EOL;

/**
 * 一个通用的函数, 获取是星期几
 *
 * @param $date
 * @return string
 */
 function getDayOfWeek($date)
{
    $days = ['一', '二', '三', '四', '五', '六', '日'];
    return '星期' . $days[date('N', strtotime($date)) - 1];
}
foreach ($dates as $date) {
    echo getDayOfWeek($date);
    echo PHP_EOL;
}
// 输出
//    星期一
//    星期二
//    星期三
//    星期四
//    星期五
//    星期六
//    星期日