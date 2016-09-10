<?php

/**
 * 测试单例模式
 */

class Foo
{
    public $name;
}

function load($name)
{
    static $class = array();
    var_dump($class);
    echo "<br />";
    if (!isset($class[$name])) {
        $class[$name] = new $name();
    }
    return $class[$name];
}

function test()
{
    $a = load('Foo');
    $a->name = 'a1';
}

function test2()
{
    $a2 = load('Foo');
    echo $a2->name;
}


test();
test2();
// 输出
//    array(0) { }
//    array(1) { ["Foo"]=> object(Foo)#1 (1) { ["name"]=> string(2) "a1" } }
//    a1
