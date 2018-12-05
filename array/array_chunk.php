<?php
$array = ['name' => 'tom', 'age' => 20, 3, 4, 5, 'a', 'b'];
$chunk_result = array_chunk($array, 3);
print_r($chunk_result);

// 保留原先的键
$chunk_result = array_chunk($array, 3, true);
print_r($chunk_result);