<?php

function cube($n) {
    return $n * $n * $n;
}

$a = array(1, 2, 3, 4, 5);
$b = array_map('cube', $a);
print_r($b);

// 测试数组通过指针传递

function getName($n) {
    $a = array(1 => 'tom', 2 => 'hauer');
    return $a[$n['id']];
}

$users = array(
    array(
        'id' => 1
    ),
    array(
        'id' => 2
    )
);
array_map('getName', $users);
print_r($users);
