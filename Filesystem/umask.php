<?php

$dir = __DIR__;
$file = $dir . '/tmp.log';

$old = umask(0);
chmod($file, 0755);
umask($old);

if ($old != umask()) {
    die('An error occured while changing back the umask');
}