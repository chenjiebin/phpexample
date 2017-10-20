<?php
echo '<pre>';
$a = array('a', 'b');
$b = array('c', 'b');
var_dump($a + $b);
var_dump(array_merge($a, $b));

echo PHP_EOL;
$a = array(0 => 'a', 1 => 'b');
$b = array(0 => 'c', 1 => 'b');
var_dump($a + $b);
var_dump(array_merge($a, $b));

echo PHP_EOL;
$a = array('a', 'b');
$b = array(0 => 'c', 1 => 'b');
var_dump($a + $b);
var_dump(array_merge($a, $b));

echo PHP_EOL;
$a = array(0 => 'a', 1 => 'b');
$b = array('0' => 'c', '1' => 'b');
var_dump($a + $b);
var_dump(array_merge($a, $b));

echo PHP_EOL;
$a = array(0 => array('a'), 1 => array('b'));
$b = array('0' => array('c'), '1' => array('b'));
var_dump($a + $b);
var_dump(array_merge($a, $b));
echo '</pre>';