<?php
/**
 * 获取命令行参数
 */

// $argv 可以捕获命令行中php命令后的参数, 以空格分离
// 参考下面所示
var_dump($argv);
// 执行命令
//    $ php getopt.php www.01happy.com
// 输出
//    array(2) {
//        [0]=>
//      string(10) "getopt.php"
//        [1]=>
//      string(11) "www.01happy.com"
//    }



// $argc 可以获取到参数个数
var_dump($argc);
// 执行命令
//    $ php getopt.php www.01happy.com
// 输出
//    int(2)



// 使用getopt参数可以获取命令行更加复杂的参数
// 如短参数: php getopt.php -s www.01happy.com -y 2012
// 如长参数: php getopt.php --site www.01happy.com --year 2012

// 短参数示例
// 短参数就是一个字符的选项, 只允许 a-z、A-Z 和 0-9
$opt  = getopt('s:y:');
var_dump($opt);
// 执行命令
//    $ php getopt.php -s www.01happy.com -y 2012
// 输出
//    array(2) {
//        ["s"]=>
//      string(15) "www.01happy.com"
//        ["y"]=>
//      string(4) "2012"
//    }

// 长参数示例
$opt  = getopt('', ['site:', 'year:']);
var_dump($opt);
// 执行命令
//    $ php getopt.php --site www.01happy.com --year 2012
// 输出
//    array(2) {
//        ["site"]=>
//      string(15) "www.01happy.com"
//        ["year"]=>
//      string(4) "2012"
//    }
