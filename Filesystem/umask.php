<?php


$dir = __DIR__;
$file = $dir . '/tmp.log';
file_put_contents($file, 'test umask');

$old = umask(0);
chmod($file, 0755);
umask($old);

if ($old != umask()) {
    die('An error occured while changing back the umask');
}