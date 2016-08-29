<?php

$m = new Memcached();
$m->addServer('127.0.0.1', 11211);

$m->set('name', 'hauer');
echo $m->get('name');


$items = array(
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => 'value3'
);
$m->setMulti($items);
$m->getDelayed(array('key1', 'key3'), true, 'callback');

function callback($memc, $item) {
    var_dump($item);
}

$profileInfo = $m->get('user:1', 'userInfoCb');

function userInfoCb($memc, $key, &$value) {
    $profileInfo = array('user_id' => 1, 'user_name' => 'hauer');
    $value = $profileInfo;
    return true;
}
var_dump($profileInfo);