<?php

/**
 * 类中定义常量
 */
class Foo
{

    const STATUS_CONFIG = array(
        '1' => 'success',
        '2' => 'fail',
    );

}

var_dump(Foo::STATUS_CONFIG);
