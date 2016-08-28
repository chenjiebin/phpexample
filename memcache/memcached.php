<?php

$m = new Memcached();
$m->addServer('127.0.0.1', 11211);
$m->set('name', 'hauer');
echo $m->get('name');
