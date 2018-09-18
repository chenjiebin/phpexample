<?php


echo pow(10, 1000);
echo PHP_EOL;
exit();



$GLOBALS['a'] = false;

var_dump(!isset($GLOBALS['a']));

a();
a();
a();
a();

function a()
{
    static $a = 0;
    $a++;
    echo $a;
    echo '<br />';
}