<?php
/**
 * 可以从数组中随机获取若干个键
 */

// 1. 生成a-z随机数组
$inputs = [];
for ($i = 0; $i < 32; $i++) {
    $inputs[$i] = chr(mt_rand(97, 122));
}
print_r($inputs);
// 输出:
//    Array
//    (
//        [0] => n
//        [1] => m
//        [2] => f
//        [3] => o
//        [4] => x
//        [5] => h
//        [6] => k
//        [7] => d
//        [8] => g
//        [9] => w
//        [10] => s
//        [11] => l
//        [12] => r
//        [13] => z
//        [14] => a
//        [15] => v
//        [16] => l
//        [17] => e
//        [18] => c
//        [19] => f
//        [20] => c
//        [21] => o
//        [22] => c
//        [23] => a
//        [24] => u
//        [25] => g
//        [26] => v
//        [27] => s
//        [28] => m
//        [29] => w
//        [30] => s
//        [31] => h
//    )

// 2. 随机获取一个
$rand_key = array_rand($inputs, 1);
print_r($rand_key);
// 输出: 15
print_r($inputs[$rand_key]);
// 输出: v

// 3. 随机获取多个
$rand_keys = array_rand($inputs, 5);
print_r($rand_keys);
// 输出:
//    Array
//    (
//        [0] => 3
//        [1] => 4
//        [2] => 17
//        [3] => 26
//        [4] => 29
//    )
$rand_values = [];
foreach ($rand_keys as $key) {
    $rand_values[] = $inputs[$key];
}
print_r($rand_values);
// 输出:
//    Array
//    (
//        [0] => x
//        [1] => z
//        [2] => c
//        [3] => p
//        [4] => q
//    )

