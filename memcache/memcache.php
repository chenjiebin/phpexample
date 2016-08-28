<?php

$memcache_obj = memcache_connect("localhost", 11211);

// 面向过程编程 API
memcache_add($memcache_obj, 'var_key', 'test variable', false, 30);

// 面向对象编程 API
$memcache_obj->add('var_key', 'test variable', false, 30);

echo $memcache_obj->get('var_key');
