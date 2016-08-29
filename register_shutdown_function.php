<?php

/**
 * php脚本在执行完成后会执行该方法
 */
function shutdown() {
    // This is our shutdown function, in 
    // here we can do any last operations
    // before the script is complete.

    echo 'Script executed with success', PHP_EOL;

    $error = error_get_last();
    var_dump($error);
}

register_shutdown_function('shutdown');

hello();
