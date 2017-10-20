<?php
echo '<pre>';

$a = array('a', 'b');
$b = array('c', 'b');

var_dump(array_diff($a, $b));
var_dump(array_diff($b, $a));

echo '</pre>';