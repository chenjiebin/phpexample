<?php
/**
 * 测试一下php中array直接用加号相加的情况
 */
$a = array('a', 'b');
$b = array('c', 'b');
print_r($a + $b);

echo PHP_EOL;
$a = array(0 => 'a', 1 => 'b');
$b = array(0 => 'c', 1 => 'b');
print_r($a + $b);

echo PHP_EOL;
$a = array('a', 'b');
$b = array(0 => 'c', 1 => 'b');
print_r($a + $b);

echo PHP_EOL;
$a = array(0 => 'a', 1 => 'b');
$b = array('0' => 'c', '1' => 'b');
print_r($a + $b);

echo PHP_EOL;
$a = array(0 => array('a'), 1 => array('b'));
$b = array('0' => array('c'), '1' => array('b'));
print_r($a + $b);