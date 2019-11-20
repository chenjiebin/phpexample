<?php
// 计算文件相似度

// 两个字符串相差 "技术" 和 "http://"
$str1 = "快乐编程是一个通俗易懂的技术博客www.01happy.com";
$str2 = "快乐编程是一个通俗易懂的博客http://www.01happy.com";
echo similar_text($str1, $str2, $percent);
// 输出 57, 实际上就是相似字符串的长度: strlen("快乐编程是一个通俗易懂的") + strlen("博客") + strlen("www.01happy.com")
echo PHP_EOL;
echo $percent;
// 输出 89.763779527559,
