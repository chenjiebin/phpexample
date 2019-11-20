<?php
// 计算字符串1到字符串2的编辑距离

// 两个字符串相差 "技术" 和 "http://"
$str1 = "快乐编程是一个通俗易懂的技术博客www.01happy.com";
$str2 = "快乐编程是一个通俗易懂的博客http://www.01happy.com";
echo levenshtein($str1, $str2);
// 输出13, 实际上就是 strlen("技术") + strlen("http://")

