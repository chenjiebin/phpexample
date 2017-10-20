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
echo '</pre>';
//    结果
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//    2 => string 'c' (length = 1)
//    3 => string 'd' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//    2 => string 'c' (length = 1)
//    3 => string 'b' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//    2 => string 'c' (length = 1)
//    3 => string 'b' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//
//    array
//        0 => string 'a' (length = 1)
//    1 => string 'b' (length = 1)
//    2 => string 'c' (length = 1)
//    3 => string 'b' (length = 1)