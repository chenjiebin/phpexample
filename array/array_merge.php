<?php
/**
 * 测试一下php中array直接用加号相加的情况
 */
// 测试一下数字键的情况
$a = ['a', 'b'];
$b = ['c', 'd', 'e'];
print_r(array_merge($a, $b));

// 测试一下字符键的情况
$a = ['name' => 'jack', 'age' => 20];
$b = ['name' => 'tom', 'age' => 21, 'gender' => 'male'];
print_r(array_merge($a, $b));